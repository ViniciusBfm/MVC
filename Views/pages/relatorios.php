<section class="container-box">
    <div class="titulo bg-primary text-white">
        <p class="fs-3 fw-semibold" style="margin: 0;">Relatorios</p>
        <p>Simplifique seu controle em um único lugar.</p>
    </div>
    <div class="categorias-relatorios-container">
        <p class="fs-5 fw-semibold">Categorias principais</p>
        <div class="relatorios-box">
            <div class="icone-relatorio bg-dark">
                <img src="<?= INCLUDE_IMAGES; ?>/relat-geral.png" alt="">
            </div>
            <div class="text-relatorio">
                <p class="fs-5 fw-semibold">Relatório geral</p>
                <p>Relatório geral informando o número total de impressões</p>
                <p style="font-size: 12px; margin-bottom: 5px;">Extensão do arquivo: PDF</p>
                <button type="button" class="btn btn-dark">Gerar relatório</button>
            </div>
        </div>
        <div class="relatorios-box">
            <div class="icone-relatorio bg-dark">
                <img src="<?= INCLUDE_IMAGES; ?>/relat-user.png" alt="">
            </div>
            <div class="text-relatorio">
                <p class="fs-5 fw-semibold">Relatório por usuário</p>
                <p>Relatório informando o número de copias por mês</p>
                <p style="font-size: 12px; margin-bottom: 5px;">Extensão do arquivo: PDF</p>
                <button type="button" class="btn btn-dark">Gerar relatório</button>
            </div>
        </div>
        <div class="relatorios-box">
            <div class="icone-relatorio bg-dark">
                <img src="<?= INCLUDE_IMAGES; ?>/relat-setor.png" alt="">
            </div>
            <div class="text-relatorio">
                <p class="fs-5 fw-semibold">Relatório por setor</p>
                <p>Relatório informando as impressões por setor</p>
                <p style="font-size: 12px; margin-bottom: 5px;">Extensão do arquivo: PDF</p>
                <button type="button" class="btn btn-dark">Gerar relatório</button>
            </div>
        </div>
        <div class="relatorios-box">
            <div class="icone-relatorio bg-dark">
                <img src="<?= INCLUDE_IMAGES; ?>/relat-impressao.png" alt="">
            </div>
            <div class="text-relatorio">
                <p class="fs-5 fw-semibold">Todas as impressões realizadas</p>
                <p>Relatório informando todas as impressões realizadas até o momento</p>
                <p style="font-size: 12px; margin-bottom: 5px;">Extensão do arquivo: Web</p>
                <a href="<?= INCLUDE_PATH;?>impressoes" class=" btn btn-dark">Visualizar</a>
            </div>
        </div>
    </div>
</section>