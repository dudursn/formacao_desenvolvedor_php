<?php 


try{
	
	if(trim($_POST["txtDescricao"])!=""){
		
		$entityManager = (new \Alura\Cursos\Infra\EntityManagerCreator())->getEntityManager();
		$curso = new \Alura\Cursos\Entity\Curso();
		$curso->setDescricao($_POST["txtDescricao"]);
		$entityManager->persist($curso);
		$entityManager->flush();
		$_SESSION["msg"] = "Salvo com sucesso. ";
		header("Location: listar-cursos");
	}else{
		$_SESSION["msg"] = "Erro ao inserir curso. Campo descrição vazio. ";
		header("Location: novo-curso");
	}


}catch(Exception $e){
	echo $e->getMessage();
}

?>