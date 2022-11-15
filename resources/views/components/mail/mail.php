<main class="main">
    <div class="card">
        <div class="title">
            <header class="header">
                <a href="#"><img class="logo" src="https://imgfz.com/i/CmrXR5c.jpeg" alt=""></a>
                <h1 class="title-header">
                    <?php
                    if (isset($header)) {
                        echo $header;
                    }
                    ?>
                </h1>
            </header>
            <p class="description">
                <?php
                if (isset($description)) {
                    echo $description;
                }
                    ?>
            </p>
        </div>
        <div class="action">
            <a id="verify-email" href="http://localhost/perezlara/" class="quaternary-button a-button button-is-red">
                <?php
                    if (isset($button)) {
                        echo $button;
                    }
                    ?>
            </a>
        </div>
    </div>
</main>