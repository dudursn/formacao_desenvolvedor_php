<?php 

namespace Alura\Doctrine\Helper;

//Graças ao composer, não se precisa utilizar o require o tempo todo
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;


//Classe gerenciadora de entidades
class EntityManagerFactory{

	public function getEntityManager(): EntityManagerInterface{

		//Diretório onde será buscada as classes de anotações
		$rootDir = __DIR__ . "/../..";

		//Modo de desenvolvimento(true) ou de produção
		$isDevMode = true;

		//Cria a configuração para mapeamento das entidades 
		$config = Setup::createAnnotationMetadataConfiguration(
			[$rootDir . "/src"],
			$isDevMode
		);
		/*
		//Dados de conexão com o sqlite
		$connection = [

			"driver" => "pdo_sqlite",
			"path" => $rootDir . "/var/data/banco.sqlite"
		];
		*/
		
		//Dados de conexão com o mysql
		$connection = [
			"dbname" => "sisteste",
			"user" => "root",
			"password" => "",
			"host" => "localhost",
			"driver" => "pdo_mysql"
		];
		
		//Retorna o gerenciador de entidades
		return EntityManager::create($connection, $config);
	}
}

?>