<?php
// Função para verificar se o usuário atual está seguindo o usuário seguido
function verificarSeSegueUsuario($usuarioAtual, $usuarioSeguido) {
  // Lógica de verificação real aqui
  // Você precisa implementar a lógica para verificar se o usuário atual está seguindo o usuário seguido
  // Por exemplo, suponha que você tenha uma tabela no banco de dados chamada "seguir" com os campos "ID_SEGUINDO" e "ID_SEGUIDO"
  // Você pode executar uma consulta para verificar se existe uma entrada na tabela com os IDs corretos:
  
  // Conecta-se ao banco de dados
  include "../conexao.php";
  
  // Query para verificar se existe uma entrada de seguimento com os IDs corretos
  $sql = "SELECT * FROM seguir WHERE ID_SEGUINDO_SEGUIR = '$usuarioAtual' AND perfil_ID_PERFIL = '$usuarioSeguido'";
  $resultado = mysqli_query($con, $sql);

  // Verifica se a consulta retornou algum resultado
  if (mysqli_num_rows($resultado) > 0) {
    echo  "O usuário atual está seguindo o usuário seguido";
    mysqli_close($con);
  } else {
     echo "O usuário atual não está seguindo o usuário seguido";
    mysqli_close($con);
  }
}
?>

