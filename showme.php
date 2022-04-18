<?php		//! A traiter les cas d'erreurs
// Désactiver le rapport d'erreurs
error_reporting(E_ALL);

require_once('config.php');

//Déclaration des variables, constantes et fonctions
$message = '';
if(isset($_GET['message'])) {
	$message = $_GET['message'];
}

$title = '';
$consultations = [];

$year = date('Y');
if(!empty($_GET['selectYear'])) {
	if(is_numeric($_GET['selectYear']) && strlen($_GET['selectYear'])==4) {
		$year = $_GET['selectYear'];
	} else {
		$message = "Format <strong>incorrect</strong> pour l'année!";
	}
}
/**
 * Envoie une requête au serveur de BD pour extraire les données et les champs
 *
 * @param $mysqli mysqli Le lien de connexion à la base de données
 * @param $query  string La requête SQL
 * @return array	Un tableau contenant les enregistrements trouvés en indice 0
 * 					et les champs correspondants en indice 1.
 */
function extractData($mysqli, $query) {
	$tabResults = [];
	
	//Envoyer la requête
	$result = mysqli_query($mysqli, $query);

	//Traiter, analyser le résultat
	if($result) {
		$tabResults = mysqli_fetch_all($result,MYSQLI_ASSOC);
		
		$fields = mysqli_fetch_fields($result);
		
		//Libérer le résultat
		mysqli_free_result($result);
	} else {
		return false;
	}
	
	return [$tabResults, $fields];
}

//Récupérer les données entrantes
$select = isset($_GET['select']) ? $_GET['select'] : '';

//Se connecter au serveur
$mysqli = mysqli_connect(HOSTNAME,USERNAME,PASSWORD);

if($mysqli) {
	//Configuration éventuelle
	mysqli_query($mysqli,'SET NAMES utf8');
	
	//Sélectionner la db
	if(mysqli_select_db($mysqli,DATABASE)) {	
		//Choix de la requête
		switch($select) {
			//Préparer une requête
			case 2: 
				$query = 'SELECT * FROM consultation LIMIT 10';
				$title = 'Liste des consultations';
				break;
			case 3: 
				$query = 'SELECT type FROM animaux'; 
				$title = 'Liste des animaux';
				break;
			case 4:
				$query = 'SELECT idConsult, sexe, nomclient FROM consultation
					WHERE ville="Ivry" ORDER BY sexe ASC'; 
				$title = 'Liste des clients d\'Ivry';
				break;
			case 5:
				$query = 'SELECT idConsult, sexe, nomclient FROM consultation
					WHERE ville<>"Fos" AND paye=1'; 
				$title = 'Liste des clients hors Fos qui ont payé';
				break;
			case 6:
				$query = 'SELECT consultation.nomclient,animaux.type 
					FROM consultation, animaux
					WHERE consultation.idAnimal=animaux.idAnimal
					AND (animaux.type="chien" OR animaux.type="chat")'; 
				$title = 'Liste des clients qui ont amené un chien ou un chat';
				break;
			case 7:
				//Nettoyer la variable d'entrée utilisateur
				$year = mysqli_real_escape_string($mysqli, $year);
				
				$query = "SELECT * FROM consultation
					GROUP BY idConsult
					HAVING YEAR(dc)=$year";
				$queryYears = 'SELECT DISTINCT year(DC) FROM `consultation` ORDER BY DC ASC';
				$title = "Liste des consultations de l'année $year";
				break;
			default:
				$query = 'SELECT * FROM consultation';
				$title = 'Liste des consultations';
		}
		
		//Envoyer la requête et extraire les données
		$data = extractData($mysqli, $query);
		
		if($data!==false) {
			if(!empty($data[0])) {
				$consultations = $data[0];	//var_dump($consultations);die;
			} else {
				$message = 'Aucun résultat trouvé!';
			}
			$fields = $data[1];
		} else {
			$message = 'Une erreur s\'est produite avec la requête.';
			$message .= ' ('.mysqli_error($mysqli).')';
		}
		
		//Traiter les requêtes supplémentaires
		if(isset($queryYears)) {
			$data = extractData($mysqli, $queryYears);
			
			if($data!==false) {
				$years = $data[0];
				
				//Parcourir le tableau pour remplacer le sous-tableau par l'année
				for($i=0;$i<count($years);$i++) {
					$years[$i] = $years[$i]['year(DC)'];
				}
				/*
				foreach($years as $index => &$tabYear) {
					$tabYear = $tabYear['year(DC)'];
				}
				*/
				//var_dump($years);die;
			} else {
				$message = 'Une erreur s\'est produite avec la requête.';
				$message .= ' ('.mysqli_error($mysqli).')';
			}
		}
		
	} else {
		$message = 'Base de données inconnue.';
		$message .= ' ('.mysqli_error($mysqli).')';
	}
	//Fermer la connexion
	mysqli_close($mysqli);
} else {
	$message = "Erreur de connexion. Veuillez réessayer plus tard.";
}
//Afficher le résultat/les données
//var_dump($consultations);
?>

<?php include(SERVER_ROOT.'/header.inc.php'); ?>
<?php include(SERVER_ROOT.'/menu.inc.php'); ?>

	<h1><?php echo $title; ?></h1>
<?php if(!empty($message)) { ?>
	<div class="alert alert-warning"><?php echo $message; ?></div>
<?php } ?>

<?php if(isset($years)) { ?>	
	<form id="frmSelectYear" class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
		<input name="select" type="hidden" value="7">
		<div class="form-group">
			<label for="selectYear">Année:</label>
		<!--	<input name="inputYear" type="text" maxlength="4" pattern="^\d{4}$">	-->
			<select name="selectYear" class="form-control">
				<option></option>
		<?php foreach($years as $year) { ?>
				<option <?php echo (isset($_GET['selectYear']) && $_GET['selectYear']==$year) 
								? 'selected' : ''; ?>><?php echo $year; ?></option>
		<?php } ?>
			</select>
			<button class="btn btn-primary">Afficher</button>
		</div>
	</form>
<?php } ?>

<?php if(sizeof($consultations)>0) { ?>
	<table border="1">
		<thead>
			<tr>
				<th>Actions</th>
			<?php foreach($fields as $field) { ?>
				<th><?php echo $field->name; ?></th>
			<?php } ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="<?php echo sizeof($fields)+1; ?>">
					<?php echo sizeof($consultations); ?> résultats trouvés
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php for($i=0;$i<sizeof($consultations);$i++) { ?>
			<tr class="<?php echo ($i%2==0) ? "odd" : "even" ?>">
			
			<?php if(isset($consultations[$i]['IdConsult'])) { ?>
				<td><a href="admin/updatetable.php?id=<?php echo $consultations[$i]['IdConsult'] ?>"><i class="fas fa-pencil-alt"></i></a></td>
			<?php } elseif(isset($_GET['select']) && $_GET['select']==3) { ?>	
				<td>
					<form action="admin/add_picture.php" method="post">
						<input type="file" name="picture">
						<button type="button" onclick="loadPicture( $(this).parent().find('input[name=picture]') )"><i class="fas fa-camera"></i></button>
						<button><i class="fas fa-eye"></i></button>
					</form>
				</td>
			<?php } else { ?>
				<td></td>
			<?php } ?>
			
			<?php foreach($consultations[$i] as $fieldValue) { ?>
				<td ondblclick="replaceField(this)"><?php echo htmlentities($fieldValue); ?></td>
			<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php } ?>

<?php include(SERVER_ROOT.'/footer.inc.php'); ?>








