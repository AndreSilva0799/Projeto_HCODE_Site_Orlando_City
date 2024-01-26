<?php
require 'inc/configuration.php';
require 'inc/Slim-2.x/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () {
    require_once("view/index.php");
});

$app->get('/view/videos', function () {
    require_once("view/videos.php");
});

$app->get('/view/shop', function () {
    require_once("view/shop.php");
});

$app->get('/produtos', function () {
    $sql = new Sql();
    $data = $sql->select("SELECT * FROM hcode_shop.tb_produtos WHERE preco_promorcional > 0 ORDER BY preco_promorcional DESC LIMIT 3;");

    if (is_array($data) && !empty($data)) {
        foreach ($data as &$produto) {
            $preco = $produto['preco'];
            $centavos = explode(".", $preco);
            $produto['preco'] = number_format($preco, 0, ",", ".");
            $produto['centavos'] = end($centavos);
            $produto['parcelas'] = 10;
            $produto['parcela'] = number_format($preco / $produto['parcelas'], 2, ",", ".");
            $produto['total'] = number_format($preco, 2, ",", ".");
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
});

$app->get('/produtos-mais-buscados', function () {
    $sql = new Sql();

    $data = $sql->select("SELECT 
        tb_produtos.id_prod,
        tb_produtos.nome_prod_curto,
        tb_produtos.nome_prod_longo,
        tb_produtos.codigo_interno,
        tb_produtos.id_cat,
        tb_produtos.preco,
        tb_produtos.peso,
        tb_produtos.largura_centimetro,
        tb_produtos.altura_centimetro,
        tb_produtos.quantidade_estoque,
        tb_produtos.preco_promorcional,
        tb_produtos.foto_principal,
        tb_produtos.visivel,
        CAST(AVG(review) AS DECIMAL(10,2)) AS media, 
        COUNT(id_prod) AS total_reviews
        FROM tb_produtos 
        INNER JOIN tb_reviews USING(id_prod) 
        GROUP BY 
        tb_produtos.id_prod,
        tb_produtos.nome_prod_curto,
        tb_produtos.nome_prod_longo,
        tb_produtos.codigo_interno,
        tb_produtos.id_cat,
        tb_produtos.preco,
        tb_produtos.peso,
        tb_produtos.largura_centimetro,
        tb_produtos.altura_centimetro,
        tb_produtos.quantidade_estoque,
        tb_produtos.preco_promorcional,
        tb_produtos.foto_principal,
        tb_produtos.visivel
        LIMIT 4;");

    if (is_array($data) && !empty($data)) {
        foreach ($data as &$produto) {
            $preco = $produto['preco'];
            $centavos = explode(".", $preco);
            $produto['preco'] = number_format($preco, 0, ",", ".");
            $produto['centavos'] = end($centavos);
            $produto['parcelas'] = 10;
            $produto['parcela'] = number_format($preco / $produto['parcelas'], 2, ",", ".");
            $produto['total'] = number_format($preco, 2, ",", ".");
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
});

$app->get("/view/produto-:id_prod", function ($id_prod) {
    $sql = new Sql();
    $produtos = $sql->select("SELECT * FROM tb_produtos WHERE id_prod = $id_prod");
    $produto = $produtos[0];

    $preco = $produto['preco'];
    $centavos = explode(".", $preco);
    $produto['preco'] = number_format($preco, 0, ",", ".");
    $produto['centavos'] = end($centavos);
    $produto['parcelas'] = 10;
    $produto['parcela'] = number_format($preco / $produto['parcelas'], 2, ",", ".");
    $produto['total'] = number_format($preco, 2, ",", ".");

    require_once("view/shop-produto.php");
});

$app->get('/view/cart', function () {
    require_once("view/cart.php");
});

$app->get('/view/carrinho-dados', function () {
    $sql = new Sql();

    /*var_dump("CALL sp_carrinhos_get('" . session_id() . "')");
    exit;  ------- usei esse var dump para ver se a consulta está gerando um sesion_id para gerar precisei colocar o session start no arquivo de configuration ---- */

    $result = $sql->select("CALL sp_carrinhos_get('" . session_id() . "')");


    $carrinho = $result[0];

    $sql = new Sql();

    $carrinho['produtos'] = $sql->select("CALL sp_carrinhosprodutos_list(".$carrinho['id_car'].")");

    $carrinho['total_car'] = number_format((float)$carrinho['total_car'], 2, ',', '.');
    $carrinho['subtotal_car'] = number_format((float)$carrinho['subtotal_car'], 2, ',', '.');
    $carrinho['frete_car'] = number_format((float)$carrinho['frete_car'], 2, ',', '.');

    echo json_encode($carrinho);

});

$app->get('/view/carrinhoAdd-:id_prod', function ($id_prod) {
    
    /*var_dump($id_prod);
    exit;    --- usei esse var dump para verificar se o id do produto está passando pela rota quando clicar no botão de comprar da pagina de detalhe do produto -- */
    
    $sql = new Sql();

    $result = $sql->select("CALL sp_carrinhos_get('" . session_id() . "')");

        $carrinho = $result[0];

        $sql = new Sql();

        $sql->select("CALL sp_carrinhosprodutos_add(" . $carrinho['id_car'] . "," . $id_prod . ")");

        header("location: cart");
        exit;
    
    
});

$app->delete("/view/carrinhoRemoveAll-:id_prod", function($id_prod){

    $sql = new Sql();

    $result = $sql->select("CALL sp_carrinhos_get('" . session_id() . "')");

    $carrinho = $result[0];

    $sql = new Sql();

    $sql -> select("CALL sp_carrinhosprodutostodos_rem(".$carrinho['id_car'].", ".$id_prod.")");

    echo json_encode(array(
        "success" => true,
    ));
});

$app->post("/view/carrinho-produto", function() {

    $data = json_decode(file_get_contents("php://input"), true);
    
   

    $sql = new Sql();

    $result = $sql->select("CALL sp_carrinhos_get('" . session_id() . "')");

    $carrinho = $result[0];

    $sql = new Sql();

    $sql -> select("CALL sp_carrinhosprodutos_add(".$carrinho['id_car'].", ". $data['id_prod'].")");

    echo json_encode(array(
        "success" => true,
    ));
    
});


$app->delete("/view/carrinho-produto", function() {

    $data = json_decode(file_get_contents("php://input"), true);
    
   

    $sql = new Sql();

    $result = $sql->select("CALL sp_carrinhos_get('" . session_id() . "')");

    $carrinho = $result[0];

    $sql = new Sql();

    $sql -> select("CALL sp_carrinhosprodutos_rem(".$carrinho['id_car'].", ". $data['id_prod'].")");

    echo json_encode(array(
        "success" => true,
    ));
    
});

$app->get("/view/calcular-frete-:cep", function($cep){

    require_once("inc/php-calcular-frete-correios-master/Frete.php");

    $sql = new Sql();

    $result = $sql->select("CALL sp_carrinhos_get('" . session_id() . "')");

    $carrinho = $result[0];

    $sql = new Sql();

    $produtos = $sql-> select("CALL sp_carrinhosprodutosfrete_list(".$carrinho['id_car'].")");

    $peso = 0; 
    $comprimento = 0; 
    $altura = 0;
    $largura = 0; 
    $valor = 0;

    foreach ($produtos as $produto) {
        
        $peso =+ $produto['peso'];
        $comprimento =+ $produto['comprimento'];
        $altura =+ $produto['altura'];
        $largura =+ $produto['largura'];
        $valor =+ $produto['preco'];
    }

    $cep = trim(str_replace('-','',$cep));

    $frete = new Frete(
        $cepDeOrigem = '01418100', 
        $cepDeDestino = $cep,
        $peso, 
        $comprimento, 
        $altura, 
        $largura, 
        $valor
    );

    $sql = new Sql();

    $sql->select("UPDATE tb_carrinhos 
    set cep_car = '".$cep."', frete_car = ".$frete->getValor().",
    prazo_car = ".$frete->getPrazoEntrega()."
    where id_car = ".$carrinho['id_car']
    );

    echo json_encode(array(
        'success' => true,
    ));

});


$app->run();
?>