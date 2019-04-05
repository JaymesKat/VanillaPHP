</main>
<footer class="page-footer orange">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">App Description</h5>
        <p class="grey-text text-lighten-4">This is a pet project implemented to demonstrate CRUD functionality.</p>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    © 2019 Copyright <span class="right">Made with <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a></span>
    </div>
  </div>
</footer>


  <!--  Scripts-->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <?php 
   echo strpos($_SERVER['REQUEST_URI'], '/users') == 0? "<script src='js/scripts.js'></script>":"";
  ?>
  </body>
</html>
