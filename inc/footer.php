<br>
    </main> <!-- /container -->

        <footer class="container">
            <?php $data = new DateTime ("now", new DateTimeZone("America/Sao_Paulo")); ?>
            <p class="text-center">&copy;2024 a <?php echo $data->format ("Y")?> - Kevin e Leandro</p>
        </footer>

    <script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/main.js"></script>
    </body>
</html>