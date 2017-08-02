<?php
/**
* Pour instancier chaque objet encombrant/bulkywaste.
*/
class BulkyWaste
{
	//////// I - ATTRIBUTS

	private $_id;
	private $_dat;
	private $_type;
	private $_lat;
	private $_lng;
	private $_address;
	private $_archives;

	
	//////// II - CONSTRUCTEUR & HYDRATATION

	///// A - CONSTRUCTEUR :

	// On veut rentrer dans l'objet bw instancié plusieurs attributs.
	// On rentre donc en argument un array :
	function __construct(array $dataInstance)
	{
		$this->hydrate($dataInstance);
	}

	///// B - HYDRATATION :

	// à l'INSTANCIATION de notre objet BulkyWaste, on l'hydrate (cette fonction hydrate est en effet appelée dans le CONSTRUCTEUR)
	// (l'array "$row" représente une ligne qui comporte, dans chaque colonne, chaque attribut de l'objet bw)
	public function hydrate(array $row)
	{
		// si la valeur de l'id existe...
		if (isset($row['id']))
		{
			// ... on injecte cette valeur dans l'attribut id de l'objet bw :
			$this->setId($row['id']);			
		}
		if (isset($row['dat']))
		{
			$this->setDate($row['dat']);			
		}
		if (isset($row['type']))
		{
			$this->setType($row['type']);		
		}
		if (isset($row['lat']))
		{
			$this->setLat($row['lat']);		
		}
		if (isset($row['lng']))
		{
			$this->setLng($row['lng']);		
		}
		if (isset($row['address']))
		{
			$this->setAddress($row['address']);		
		}
		if (isset($row['archives']))
		{
			$this->setArchives($row['archives']);		
		}
	}
	///// B
	//////// II


	//////// III - GETTERS & SETTERS

	public function getId()
	{
		return $this->_id;
	}
	public function setId($idArg)
	{
		// par sécurité, on convertit l'argument en entier (normalement il l'est déjà : l'id est récupéré automatiquement par $db->lastInsertId()) :
		$idArg = (int) $idArg;

		// si l'argument rentré n'était pas un entier, la conversion donnera $idArg = 0 : le set ne s'effectuera pas.
		if ($idArg > 0)
		{
			$this->_id = $idArg;
		}
	}

	public function getDate()
	{
		return $this->_dat;
	}
	public function setDate($datArg)
	{
		// on vérifie que le dat est bien un string :
		// if (is_string($datArg))
		// {
			$this->_dat = $datArg;
		// }
	}

	public function getType()
	{
		return $this->_type;
	}
	public function setType($typeArg)
	{
		// on vérifie que le type est bien un string :
		if (is_string($typeArg))
		{
			$this->_type = $typeArg;
		}
	}

	public function getLat()
	{
		return $this->_lat;
	}
	public function setLat($latArg)
	{
		// on vérifie que lat est bien un type float :
		// if (is_double($latArg))
		// {
			$this->_lat = $latArg;
		// }
	}

	public function getLng()
	{
		return $this->_lng;
	}
	public function setLng($lngArg)
	{
		// on vérifie que lng est bien un type float :
		// if (is_double($latArg))
		// {
			$this->_lng = $lngArg;
		// }
	}

	public function getAddress()
	{
		return $this->_address;
	}
	public function setAddress($addressArg)
	{
		// on vérifie que "$address" est bien un type string :
		if (is_string($addressArg))
		{
			$this->_address = $addressArg;
		}
	}

	public function getArchives()
	{
		return $this->_archives;
	}
	public function setArchives($archivesArg)
	{
		// on vérifie que "$archives" est bien un type string :
		if (is_int($archivesArg))
		{
			$this->_archives = $archivesArg;
		}
	}
	//////// III
}
?>