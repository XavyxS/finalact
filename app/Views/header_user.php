<header>
  <div class="menu">

    <ul>
      <div>
        <li class="menu-item hidden logo-js">
          <p><strong>JM</strong><span class="software">SOFTWARE</span></p>
        </li>
      </div>
      <?php $session = session(); ?>
      <div>
        <li class="menu-item hidden"><a href="#">Usuario: <strong><?= esc($session->get('name')) ?></strong> </a></li>
        <li class="menu-item hidden"><a href="/logout">Cerrar Sesión</a></li>
      </div>
    </ul>
  </div>
</header>