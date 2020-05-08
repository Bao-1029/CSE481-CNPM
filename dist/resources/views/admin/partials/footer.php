<footer class="footer">
    <p>A project by 59Th2 | Thuy Loi University</p>
</footer>

<?php switch ($page):
    case 'login': ?>
        <script src="js/login.min.js"></script>
    <?php
        break;
    case 'dashboard': ?>
        <script src="js/hotlines.min.js" type="module"></script>
<?php endswitch; ?>