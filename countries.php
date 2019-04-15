<?php

use VanillaPHP\Services\LocationService;
use VanillaPHP\Helpers\AuthManager;

session_start();

// Enable UTF-8 text encoding
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

require __DIR__ . '/inc/bootstrap.php';


AuthManager::redirect_unauthenticated_user_to_login($_SESSION);

$states_placeholder_msg = "No country selected";
$states = array();
$selected_country = "";
$countries = LocationService::get_countries();

if(isset($_GET['code']) && isset($_GET['country'])){
    $code = $_GET['code'];
    $selected_country = $_GET['country'];
    $states = LocationService::get_states($code);
    if(!isset($states) || count($states) == 0) {
        $states_placeholder_msg = "No states listed for country";
    }
}

include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div id="profile-page" class="row">
            <div class="col s5 z-depth-1">
                <h3 class="header">Countries</h3>
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if(isset($countries) && count($countries) > 0){
                            foreach($countries as $country){
                                echo "<tr>
                                        <td>
                                            <a href='/countries?country=$country->name&code=$country->alpha3_code'>
                                            $country->name
                                            </a>
                                        </td>
                                        <td>$country->alpha3_code</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td>
                                        Missing data:
                                    </td>
                                    <td> No data available now </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col s5 offset-s1 z-depth-1">
            <h3 class="header">States</h3>
            <p>
            <?php
            if(!isset($selected_country)){
                echo "<p>Click on a country to show its states</p>";
            } else {
                echo "<strong>$selected_country</strong>";
            }
            ?>
            <?php if(count($states) < 1) {
                echo "<p id='showStates'><em>$states_placeholder_msg</em></p>";
            } else {
                echo "<table class='striped responsive-table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capital</th>
                    </tr>
                </thead>
                <tbody>";
                foreach($states as $state){
                    echo "<tr>
                            <td>$state->name</td>
                            <td>$state->capital</td>
                        </tr>";
                    }
                echo "</tbody>
                </table>";
                }
            ?>
        </div>
    </div>
</div>
<?php
include "inc/footer.php";
?>
