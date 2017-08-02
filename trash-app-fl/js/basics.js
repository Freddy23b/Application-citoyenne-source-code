////////////////////////////////////////////////////////////////
// 
//                            PLAN
// 
/////////// I   - AJOUT D'UN BULKYWASTE
////////          A - AFFICHAGE DEMANDE CONFIRMATION
//                    \\ pages : "user-mapbw-click" \ "user-mapbw-geoloc"
////////          B - INSERTION BULKYWASTE EN DB + AFFICHAGE CONFIRMATION
//                    \\ pages : "user-mapbw-click" \ "user-mapbw-geoloc" \ "user-mapbw-typeaddress"
// 
/////////// II  - INSERTION RDV EN DB + AFFICHAGE CONFIRMATION
//                \\ page : "user-rdv"
////////          A - CHECK CONDITIONS 1 & 2
////////          B - CONDITIONS 1 & 2 OK => LOAD
// 
/////////// III - RETRAIT/MISE EN ARCHIVE DU BW
//                \\ page : "employee-mapbw"
////////          A - AFFICHAGE DEMANDE CONFIRMATION
////////          B - RETRAIT/MISE EN ARCHIVE DU BULKYWASTE + AFFICHAGE CONFIRMATION
// 
/////////// IV  - RETRAIT/MISE EN ARCHIVE DU RDV
//                \\ page "employee-rdv"
////////          A - AFFICHAGE DEMANDE CONFIRMATION
////////          B - RETRAIT/MISE EN ARCHIVE DU RDV + AFFICHAGE CONFIRMATION
//
/////////// V   - FERMETURE "small-ajax-div"
//                \\ pages : "user-mapbw-click" \ "user-mapbw-geoloc" \ "employee-mapbw"
// 
// 
////////////////////////////////////////////////////////////////


/////////// I - AJOUT D'UN BULKYWASTE

//////// A - AFFICHAGE DEMANDE CONFIRMATION
//           \\ pages : "user-mapbw-click" \ "user-mapbw-geoloc"

// Chargement de la div AJAX demandant la confirmation :
function toConfirmAddBulkyWaste()
{
    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#small-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on charge la div AJAX spécifiée "#..." du fichier "ajax.php" :
        'ajax.php #ajax-loc-confirm',
        // - 2ème argument de "load()" : fonction callback :
        function()
        {
        }
    );// end "load()"
}
//////// A


//////// B - INSERTION BULKYWASTE EN DB + AFFICHAGE CONFIRMATION
//           \\ pages : "user-mapbw-click" \ "user-mapbw-geoloc" \ "user-mapbw-typeaddress"

// Envoi des valeurs vers PHP via POST + affichage de "data" dans la div AJAX réceptrice :
function addBulkyWaste()
{
    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#main-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on injecte dans le fichier php spécifié ... :
        'addbw.php',
        // - 2ème argument de "load()" :
        // ... et on envoit via POST les variables spécifiées :
        {
            'bwtype-posted': bwJsObject.type,
            'bwlat-posted': bwJsObject.lat,
            'bwlng-posted': bwJsObject.lng,
            'bwaddress-posted': bwJsObject.address
        },
        // - 3ème argument de "load()" : fonction callback :
        // dans la div réceptrice, on injecte les informations "data" traitées dans le fichier php :
        function(data)
        {
        }
    ); 
}
//////// B
/////////// I


/////////// II - INSERTION RDV EN DB + AFFICHAGE CONFIRMATION
//               \\ page "user-rdv"

// Au clic sur la balise clicable spécifiée "'#...'" :
$('#rdv-confirm-btn').on('click', function()
{
    // on saisit en variable ce qui a été posté :
    // > date :
    var datePosted = $('#datepicker').val();
    // > heure :
    var hourPosted = $('#hourposted').val();
    // > adresse :
    var addressPosted = $('#addressposted').val();
    // > nom :
    var namePosted = $('#nameposted').val();
    // > email :
    var emailPosted = $('#emailposted').val();


    //////// A - CHECK CONDITIONS 1 & 2
    
    ///// 1 - condition 1 : renseigner tous les champs

    // Si l'un des champs renseignés est vide :
    if (datePosted === '' || addressPosted === '' || namePosted === '' || emailPosted === '')
    {
        alert('Veuillez renseigner l\'ensemble des champs.');
    }
    ///// 1
    

    // Si tout est renseigné :
    else
    {
        ///// 2 - condition 2 : verifier les formats postes

        // a - Création des "RegExp" + utilisation des methods "test" :

        // > date :
        // création d'un nouvel objet "RegExp" pour vérifier le bon format de date :
        var dateRegex = /^\d{2}-\d{2}-\d{4}$/;
        // on utilise la méthode "test" de l'objet "RegExp" : on teste si ce qui a été rentré par l'utilisateur vérifie la regex :
        var dateTest = dateRegex.test(datePosted);
        
        // > l'adresse postale :
        // pour vérifier la longueur de l'adresse postale (entre 5 et 250 charactères ; "\s" pour l'acceptation des sauts de ligne) :
        var addressRegex = /^(.|\s){5,250}$/;
        // on teste ce qui a été posté :
        var addressTest = addressRegex.test(addressPosted);

        // > le nom :
        var nameRegex = /^[a-zA-Z0-9_-]{2,20}$/;
        // idem :
        var nameTest = nameRegex.test(namePosted);

        // > l'email :
        // création d'un nouvel objet "RegExp" pour vérifier un email :
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        // idem :
        var emailTest = emailRegex.test(emailPosted);

        // b - Vérifications / "barrières" :

        if (!dateTest)
        {
            alert('Veuillez utiliser le format de date proposé : "00-00-0000".');
        }
        else if (!addressTest)
        {
            alert('Votre adresse est trop courte, ou trop longue.');
        }
        else if (!nameTest)
        {
            alert('Attention, votre nom est probablement mal renseigné.');
        }
        else if (!emailTest)
        {
            alert('Veuillez rentrer un email valide.');
        }
        ///// 2
        //////// A
        

        //////// B - CONDITIONS 1 & 2 OK => LOAD

        else
        {
            // Dans la div réceptrice spécifiée "$('#...')" ...
            $('#main-ajax-div').load(
                // - 1er argument de "load()" :
                // ... on injecte dans le fichier php spécifié ... :
                'user-rdv-process.php',
                // - 2ème argument de "load()" :
                // ... et on envoit via POST les variables spécifiées :
                {
                    'dateposted': datePosted,
                    'hourposted': hourPosted,
                    'addressposted': addressPosted,
                    'nameposted': namePosted,
                    'emailposted': emailPosted
                },
                // - 3ème argument de "load()" : fonction callback :
                // dans la div réceptrice, on injecte les informations "data" traitées dans le fichier php :
                function(data)
                {
                }
            );// end "load()"
        }
        //////// B
    }
});
/////////// II


/////////// III - RETRAIT/MISE EN ARCHIVE DU BW
//                \\ page "employee-mapbw"

//////// A - AFFICHAGE DEMANDE CONFIRMATION

// Au clic sur la balise clicable spécifiée "'#...'" :
function toConfirmBulkyWasteInArchives(id)
{
    // Savoir quel bw est cliqué (son id) :
    console.log(id);
    
    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#small-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on charge la div AJAX spécifiée "#..." du fichier "ajax.php" :
        'ajax.php #ajax-take-away-confirm',
        // - 2ème argument de "load()" :
        // ... et on envoit via POST les variables spécifiées :
        // 'variable': [valeur récupérée]
        {
            'bw-id' : id
        },
        // - 3ème argument de "load()" : fonction callback :
        function()
        {
        }
    );//
}
//////// A


//////// B - RETRAIT/MISE EN ARCHIVE DU BULKYWASTE + AFFICHAGE CONFIRMATION

function bulkyWasteInArchives(id)
{
    // Savoir quel bw est cliqué (son id) :
    console.log(id);

    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#main-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on injecte dans le fichier php spécifié ... :
        'updatebw.php',
        // - 2ème argument de "load()" :
        // ... et on envoit via POST les variables spécifiées :
        {
            'id-bw-clicked': id
        },
        // - 3ème argument de "load()" : fonction callback :
        // dans la div réceptrice, on injecte les informations "data" traitées dans le fichier php :
        function(data)
        {
        }
    );
}
//////// B
/////////// III


/////////// IV - RETRAIT/MISE EN ARCHIVE DU RDV
//               \\ page "employee-rdv"

//////// A - AFFICHAGE DEMANDE CONFIRMATION

// Au clic sur la balise clicable spécifiée "'#...'" :
function toConfirmRdvInArchives(id)
{
    // Savoir quel rdv est ciblé (son id) :
    console.log(id);
    
    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#small-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on charge la div AJAX spécifiée "#..." du fichier "ajax.php" :
        'ajax.php #ajax-rdvok-confirm',
        // - 2ème argument de "load()" :
        // ... et on envoit via POST les variables spécifiées :
        // 'variable': [valeur récupérée]
        {
            'rdv-id' : id
        },
        // - 3ème argument de "load()" : fonction callback :
        function()
        {
        }
    );//
}
//////// A


//////// B - RETRAIT/MISE EN ARCHIVE DU RDV + AFFICHAGE CONFIRMATION

function rdvInArchives(id)
{
    // Savoir quel rdv est ciblé (son id) :
    console.log(id);

    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#main-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on injecte dans le fichier php spécifié ... :
        'updaterdv.php',
        // - 2ème argument de "load()" :
        // ... et on envoit via POST les variables spécifiées :
        {
            'id-rdv-clicked': id
        },
        // - 3ème argument de "load()" : fonction callback :
        // dans la div réceptrice, on injecte les informations "data" traitées dans le fichier php :
        function(data)
        {
        }
    );
}
//////// B
/////////// IV


/////////// V - FERMETURE "small-ajax-div"
//              \\ pages "user-mapbw-click" \ "user-mapbw-geoloc" \ "employee-mapbw"

function closeSmallAjaxDiv()
{
    // Dans la div réceptrice spécifiée "$('#...')" ...
    $('#small-ajax-div').load(
        // - 1er argument de "load()" :
        // ... on charge la div AJAX spécifiée "#..." du fichier "ajax.php" :
        'ajax.php #ajax-div-closed',
        // - 2ème argument de "load()" : fonction callback :
        function()
        {
        }
    );
}
/////////// V
