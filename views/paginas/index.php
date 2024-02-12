<main class="contenedor">
        <h1>Más Sobre Nosotros</h1>
        <?php include 'iconos.php' ?>
    </main>
    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        <?php
            include 'listado.php';
        ?>
        <div class="alinear-derecha">
            <a href="propiedades" class="boton-verde">Ver Todas</a>
        </div>

    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero architecto laboriosam repellendus mollitia
            sit voluptate, asperiores eum itaque vero beatae hic. Vitae suscipit id cumque aperiam blanditiis incidunt
            numquam laborum?</p>
        <a href="contacto" class="boton-amarillo">Contactanos</a>

    </section>
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img src="build/img/blog1.jpg" alt="texto entrada blog" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada">
                        <h4>Terraza en el Techo de tu Casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum consequuntur quae fugit
                            quidem, distinctio temporibus nam.
                        </p>
                    </a>

                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img src="build/img/blog2.jpg" alt="texto entrada blog" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum consequuntur quae fugit
                            quidem, distinctio temporibus nam.
                        </p>
                    </a>

                </div>
            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, commodi. Dignissimos veniam vero
                    laudantium perspiciatis.
                </blockquote>
                <p>- Ramlethal Valentine</p>
            </div>

        </section>

    </div>
</body>