<?php
/**
* Pour instancier l'objet Manager qui permet de gérer les encombrants/bulkywastes dans la DB/table.
* (lien entre : interface de l'appli  <-->  table de encombrants/bulkywastes)
*/
class BulkyWasteManager
{
	//////// I - ATTRIBUTS
	
	private $_db;


	//////// II - CONSTRUCTEUR
	
	// dès l'instance de cette class, on doit rentrer en paramètre la DB à laquelle on doit se connecter ($db) :
	function __construct($dbArg)
	{
		$this->setDb($dbArg);
	}


	//////// III - GETTERS & SETTERS
	
	public function setDb(PDO $dbArg)
	{
		$this->_db = $dbArg;
	}


	//////// IV - FONCTIONNALITES

	///// A - AJOUT, MISE A JOUR & SUPPRESSION :

	// 1 - AJOUT d'un nouvel encombrant dans la DB :
	// ("$newBw" renvoit au nouvel objet $bw instancié)
	public function addBw(BulkyWaste $newBw)
	{
		// - préparation :
		// insérer un nouvel "$newbw" dans la DB revient à y insérer une LIGNE (pour laquelle il faut renseigner les valeurs voulues) :
		$q = $this->_db->prepare('INSERT INTO ta_bulkywaste(dat, type, lat, lng, address, archives) VALUES(NOW(), :type, :lat, :lng, :address, :archives)');
		// Via ce manager, on insère dans la DB les valeurs qui ont été injectées dans l'objet bw ("$newBw") qui vient d'être instancié ;
		// on récupère ces valeurs avec les getters de l'objet bw :
		$q->bindValue(':type', $newBw->getType());
		$q->bindValue(':lat', $newBw->getLat());
		$q->bindValue(':lng', $newBw->getLng());
		$q->bindValue(':address', $newBw->getAddress());
		$q->bindValue(':archives', $newBw->getArchives());
		// - exécution :
		$q->execute();

		// une fois le bw rajouté dans la DB, il faut ATTRIBUER à l'OBJET bw instancié le même id que celui qui vient d'être généré en DB :
		$newBw->hydrate([
				'id' => $this->_db->lastInsertId()
			]);
	}
	// 1
	
	// 2 - UPDATE d'un encombrant : mise en archives après enlèvement :
	public function updateBw(BulkyWaste $bwToUpdate)
	{
		$q = $this->_db->prepare('UPDATE ta_bulkywaste SET archives = :archives WHERE id = :id');
		$q->bindValue(':archives', 1, PDO::PARAM_INT);
		$q->bindValue(':id', $bwToUpdate->getId(), PDO::PARAM_INT);
		$q->execute();
	}

	// 3 - SUPPRESSON d'un encombrant de la DB :
	public function deleteBw(BulkyWaste $bwToDelete)
	{
		$q = $this->_db->exec('DELETE FROM ta_bulkywaste WHERE id = ' . $bwToDelete->getId());
	}
	///// A
	

	///// B - AFFICHAGES :

	// 1 - Afficher le NOMBRE d'encombrants/bw encore sur la voie publique (non traités/non mis en archives) :
	public function getBwCount()
	{
		// "fetchColumn()" pour parcourir la colonne et donc en compter les lignes :
		$q = $this->_db->query('SELECT COUNT(*) FROM ta_bulkywaste WHERE archives=0')->fetchColumn();
		return $q;
	}

	// 2 - Afficher la LISTE des encombrants :
	public function getBwList()
	{
		// définition $bwList : cette liste doit être contenue dans un ARRAY (le code fonctionne sans cette ligne) :
		$bwList = [];

		// Avec "*", on sélectionne tout le contenu (les colonnes) de la table "ta_bulkywaste" :
		$q = $this->_db->query('SELECT * FROM ta_bulkywaste ORDER BY id');
	    
		// Tant qu'il y a des lignes telles que "$row" dans la table "ta_bulkywaste", on les parcourt toutes ("while").
		// Pour chaque ligne/"$row" : on parcourt chaque valeur/colonne. Grâce à "$q->fetch(PDO::FETCH_ASSOC)", on intègre dans chaque "$row" toutes ces valeurs.
		// "$row" est donc un ARRAY (dont les clés sont les attributs de la class "BulkyWaste", et dont les valeurs sont celles prélevées dans le table)
		while ($row = $q->fetch(PDO::FETCH_ASSOC))
		{
			// On rentre dans cette liste "$bwList" chaque objet BulkyWaste instancié : "new BulkyWaste($row)".
			// En effet, à chaque ligne/$row trouvée dans le table/DB, on instancie un BulkyWaste.
			// (Ex : s'il y a 48 encombrants dans la table, il y aura 48 lignes et donc 48 objets BulkyWaste instanciés)
			// Cet ARRAY "$bwList" contient donc une LISTE d'OBJETS BulkyWaste.
			// On rentre en argument de chaque objet BulkyWaste la ligne ($row) qui le définit.
			// (si on omet les "[]" de "$bwList[]", seul un objet/une ligne sera intégré dans la liste "$bwList")
			$bwList[] = new BulkyWaste($row);
		}

		// Pour pouvoir récupérer (get) et afficher cette liste, il faut la mettre en valeur de retour :
		return $bwList;
	}
	// 2

}
?>