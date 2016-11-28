<?php
/**
 * Created by PhpStorm.
 * User: meg4r0m
 * Date: 28/11/16
 * Time: 00:49
 */
echo "<html><head><style>
/* Feuille de style pour Calendrier */
table.cal { font-size:12px; background:#416DFF; border: 3px groove #0026A7; }
/* la case contenant le nom du mois */
.cal td.cal_titre { font-weight:bold; }
/* les cases des jours de la semaine */
.cal th { text-align:center; background:#0026A7; color:#DAE2FF; }
/* les autres cases */
.cal td { text-align:center; background:#DAE2FF; margin:0px; padding:0px; }
/* la case correspondant � aujourd'hui */
.cal td.today { border: 2px solid fuchsia; margin:0; padding:-2px; }
/* les cases avec un lien */
.cal td a { background:#fff; display:block; text-decoration:none; font-weight:bold; }
/* un premier style */
.cal .st1 { font-weight:bold; background:Turquoise; }
/* un second style */
.cal .st2 { font-weight:bold; color:Purple; }
</style></head><body>";

function Calendrier($month,$year) {
    $MonthNames = array(1 => "Janvier","Fevrier","Mars","Avril","Mai","Juin",
        "Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
    $monthname = $MonthNames[$month+0];

    // on ouvre la table
    echo '<table class="cal" cellspacing="1">';

    // Premi�re ligne = mois et ann�e
    $title = $monthname.' '.$year;
    echo '<tr><td colspan="7" class="cal_titre">'.$title.'</td>'."</tr>\n";

    // Seconde lignes = initiales des jours de la semaine
    $DayNames = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
    echo '<tr>'; foreach ($DayNames as $d) echo '<th>'.$d.'</th>'; echo "</tr>\n";

    // On regarde si aujourd'hui est dans ce mois pour mettre un style particulier
    if ($year == date('Y') && $month == date('m'))
        $today = date('d');
    else
        $today = 0;

    $time = mktime(0,0,0,$month,1,$year); // timestamp du 1er du mois demand�
    $days_in_month = date('t',$time);     // nombre de jours dans le mois
    $firstday = date('w',$time);          // jour de la semaine du 1er du mois
    if ($firstday == 0) $firstday = 7;    // attention, en php, dimanche = 0

    $daycode = 1; // ($daycode % 7) va nous indiquer le jour de la semaine.
    // on commence par le lundi, c'est-�-dire 1.

    // on ouvre une premi�re ligne pour le calendrier proprement dit :
    echo '<tr>';

    // on met des cases blanches jusqu'� la veille du 1er du mois :
    for ( ; $daycode<$firstday; $daycode++) echo '<td>&nbsp;</td>';

    // boucle sur tous les jours du mois :
    for ($numday = 1; $numday <= $days_in_month; $numday++, $daycode++) {
        // si on en est au lundi (sauf le 1er),
        // on ferme la ligne pr�c�dente et on en ouvre une nouvelle
        if ($daycode%7 == 1 && $numday != 1) echo "</tr>\n".'<tr>';
        // on ouvre la case (avec un style particulier s'il s'agit d'aujourd'hui)
        echo ($numday == $today ? '<td class="today">' : '<td>');
        // on affiche le num�ro du jour ou le contenu donn� par l'utilisateur
        echo $numday;
        // on ferme la case
        echo '</td>';
    }

    // on met des cases blanches pour completer la derni�re semaine si besoin :
    for ( ; $daycode%7 != 1; $daycode++) echo '<td>&nbsp;</td>';

    // on ferme la derni�re ligne, et la table.
    echo '</tr>'; echo "</table>\n\n";
}

$MoisNom = array(1 => "Janvier",2 => "Fevrier",3 => "Mars",4 => "Avril",5 => "Mai",6 => "Juin",
    7 => "Juillet",8 => "Aout",9 => "Septembre",10 => "Octobre",11 => "Novembre",12 => "Decembre");

$mois = htmlspecialchars($_POST["mois"]);
$annee = htmlspecialchars($_POST["annee"]);

echo '<form method="post" action="tp.php">
    <select name="mois">';
        foreach ($MoisNom as $numMois => $nomMois){
            echo '<option value="'.$numMois.'"';
            if ($mois != "" && $numMois == $mois){
                echo " selected";
            }elseif ($numMois == date("m")){
                echo " selected";
            }
            echo '>'.$nomMois.'</option>';
        }
    echo '</select>
    <input type="text" name="annee" placeholder="2016">
    <button type="submit"> >> </button>
</form>';

if (isset($mois) && isset($annee)){
    Calendrier($mois, $annee);
}else{
    Calendrier(date("m"), date("Y"));
}

echo "</body></html>";