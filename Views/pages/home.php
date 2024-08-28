<section style="padding: 0;" class="slider-container">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= INCLUDE_IMAGES; ?>/img1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= INCLUDE_IMAGES; ?>/img2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= INCLUDE_IMAGES; ?>/img3.jpg" class="d-block w-100" alt="...">

            </div>
        </div>
        <button style="display: none;" class="carousel-control-prev" type="button"
            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button style="display: none;" class="carousel-control-next" type="button"
            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section style="padding: 0;" class="informacao">
    <div class="container text-center">
        <div class="row justify-content-between">
            <div class="col-md-5 box1">
                <button type="button" class="btn btn-primary rounded-pill">Saiba mais</button>
            </div>
            <div class="col-md-5 box2">
                <button type="button" class="btn btn-primary rounded-pill">Saiba mais</button>
            </div>
        </div>
    </div>

</section>
<section class="infos2">
    <div class="container">
        <div class="row">
            <div class="col-md-3 fs-5 fw-semibold flex-box">
                <div>
                    <img src="<?= INCLUDE_IMAGES; ?>/info2-1.png" alt="">
                </div>
                <div>Retirada disponível</div>
            </div>
            <div class="col-md-3 fs-5 fw-semibold flex-box">
                <div>
                    <img src="<?= INCLUDE_IMAGES; ?>/info2-2.png" alt="">
                </div>
                <div>Frete grátis acima de R$250</div>
            </div>
            <div class="col-md-3 fs-5 fw-semibold flex-box">

                <div>
                    <img src="<?= INCLUDE_IMAGES; ?>/info2-3.png" alt="">
                </div>
                <div>Garantia de preços baixos</div>
            </div>
            <div class="col-md-3 fs-5 fw-semibold flex-box">
                <div>
                    <img src="<?= INCLUDE_IMAGES; ?>/info2-4.png" alt="">
                </div>
                <div>Disponível para você 24/7</div>
            </div>
        </div>
    </div>
</section>
<section class="mais-vendidos bg-white">
    <div class="container">
        <div class="row titulo2">
            <div class="col-md-12 text-center ">
                <h1 class="fs-3">Mais Vendidos</h1>
            </div>
        </div>
        <div class="row text-center box-mais-vendidos">
            <div class="col-md-3 box-produtos">
                <div class="img-produto">
                    <img src="<?= INCLUDE_IMAGES; ?>/produto.png" alt="produto">
                </div>
                <div class="titulo-produto">
                    <h1 class="fs-6">Lorem ipsum dolor sit amet consectetur adipiscing</h1>
                </div>
                <div class="valor-produto">
                    <p class="fs-4 text-primary fw-medium">R$ 700,00</p>
                </div>
                <div class="promocao text-white">
                    <h1 class="fs-6">Promoção</h1>
                </div>
            </div>
            <div class="col-md-3 box-produtos">
                <div class="img-produto">
                    <img src="<?= INCLUDE_IMAGES; ?>/produto.png" alt="produto">
                </div>
                <div class="titulo-produto">
                    <h1 class="fs-6">Donec enim mi, vehicula vel mollis id luctus a risus</h1>
                </div>
                <div class="valor-produto">
                    <p class="fs-4 text-primary fw-medium">R$ 700,00</p>
                </div>
                <div class="promocao text-white">
                    <h1 class="fs-6">Promoção</h1>
                </div>
            </div>
            <div class="col-md-3 box-produtos">
                <div class="img-produto">
                    <img src="<?= INCLUDE_IMAGES; ?>/produto.png" alt="produto">
                </div>
                <div class="titulo-produto">
                    <h1 class="fs-6">Orci varius natoque penatibus et magnis dis parturient uyth julatrs libtoçam
                    </h1>
                </div>
                <div class="valor-produto">
                    <p class="fs-4 text-primary fw-medium">R$ 700,00</p>
                </div>
                <div class="promocao text-white">
                    <h1 class="fs-6">Promoção</h1>
                </div>
            </div>
            <div class="col-md-3 box-produtos">
                <div class="img-produto">
                    <img src="<?= INCLUDE_IMAGES; ?>/produto.png" alt="produto">
                </div>
                <div class="titulo-produto">
                    <h1 class="fs-6">Vivamus faucibus dolor vel odio tempus hendrerit enim tristique</h1>
                </div>
                <div class="valor-produto">
                    <p class="fs-4 text-primary fw-medium">R$ 700,00</p>
                </div>
                <div class="promocao text-white">
                    <h1 class="fs-6">Promoção</h1>
                </div>
            </div>
        </div>
        <div class="row ver-mais">
            <div class="col-md-12 text-center ">
                <a href="<?= INCLUDE_PATH;?>produtos" class="bg-primary text-white rounded-pill fs-6 ver-btn">Ver
                    mais</a>
            </div>
        </div>

    </div>
    </div>
</section>
<section class="newsletter bg-primary text-white">
    <div class="container">
        <div class="row titulo2">
            <div class="col-md-12 text-center">
                <h1 class="fs-3">Newsletter</h1>
                <p>Assine para receber novidades e ofertas especiais</p>
                <form action="">
                    <label for="email text-left">Email:</label>
                    <div class="form-email">
                        <input style="padding-left: 10px;" type="email" class="form-control pesquisa-radius-left"
                            placeholder="Insira seu email aqui" aria-label="Insira seu email aqui">
                        <input type="submit" class="btn btn-light pesquisa-radius-right" value="Assinar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="central-ajuda">
    <div class="container">
        <div class="central-titulo">
            <h1 class="fs-2 text-white text-center">Tem dúvidas? Fale com a Central de Ajuda</h1>
        </div>
        <div class="d-flex align-items-center justify-content-between central">
            <div class="text-white central-text">
                <h1 class="fs-2">Tem dúvidas? Fale com a Central de Ajuda</h1>
                <p>Sou um parágrafo. Clique aqui para adicionar e editar seu texto. Compartilhe sua história.</p>
                <button type="button" class="btn btn-primary rounded-pill">Central de Ajuda</button>
            </div>
            <div class="ca">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= INCLUDE_IMAGES; ?>/ca-1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= INCLUDE_IMAGES; ?>/ca-2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= INCLUDE_IMAGES; ?>/ca-3.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sobre table-responsive">
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="text-left">
                    <div class="titulo-sobre fs-5 fw-bold">Endereço</div>
                    <div class="info-sobre">Pellen tesque ultrices</div>
                    <div class="info-sobre">scelerisque@lectus.com</div>
                    <div class="info-sobre">Telefone: (71) 99875-654236 </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-left">
                    <div class="titulo-sobre fs-5 fw-bold">Loja</div>
                    <div class="info-sobre"><a href="#">Praesent</a></div>
                    <div class="info-sobre"><a href="#">Vestibulum</a></div>
                    <div class="info-sobre"><a href="#">Nullam</a></div>
                    <div class="info-sobre"><a href="#">Penatibus</a></div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="text-left">
                    <div class="titulo-sobre fs-5 fw-bold">Suporte ao cliente</div>
                    <div class="info-sobre"><a href="">Praesent</a></div>
                    <div class="info-sobre"><a href="">Vestibulum</a></div>
                    <div class="info-sobre"><a href="">Nullam</a></div>
                    <div class="info-sobre"><a href="">Penatibus</a></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-left">
                    <div class="titulo-sobre fs-5 fw-bold">Política</div>
                    <div class="info-sobre"><a href="">Integer</a></div>
                    <div class="info-sobre"><a href="">Etiam</a></div>
                    <div class="info-sobre"><a href="">Aenean</a></div>
                    <div class="info-sobre"><a href="">Phasellus</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pagamentos-container">
    <div class="container">
        <div class="pagamento text-center">Métodos de Pagamentos Aceitos</div>
        <div class="imagem text-center">
            <img src="<?= INCLUDE_IMAGES; ?>/pag.webp" alt="">
        </div>
    </div>
</section>