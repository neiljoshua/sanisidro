      <footer>
        <p>
        <?php bloginfo('name')?> - &copy; <?php echo date('Y'); ?>
        </p>
        <nav class="footer-nav">
          <?php
            $args =array(
              'theme_location'=> 'footer'
              );
          ?>
          <?php wp_nav_menu($args); ?>
        </nav>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-82838385-4"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-82838385-4');
        </script>
      </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
