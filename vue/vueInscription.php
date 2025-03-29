<?php 
include "./vue/entete.php";
?>
<form action="./?action=defaut" method="POST">
   <table>
      <tr>
         <td>Nouvelle inscription</td>
      </tr>
      <tr>
         <td> Nom*: </td>
         <td><input type="text" name="nom" value="" size="30"></td>
      </tr>
      <tr >
         <td> Prenom*: </td>
         <td><input type="text" name="prenom" value="" size="30"></td>
      </tr>
      <tr >
         <td> mail*: </td>
         <td><input type="text" name="mail" value="" size="30"></td>
      </tr>
      <tr>
         <td> Ville*: </td>
         <td><input type="text" name="ville"  value="" size="30"></td>
      </tr>
      <tr>
         <td> Profession*: </td>
         <?php
         $LesProfessions = donnerLesProfessions();
         ?>
         <td><SELECT name= "profession">
            <?php
            foreach ($LesProfessions as $UneProfession){
               echo "<option value = '$UneProfession'>$UneProfession</option>";
            }
            ?>
             </SELECT>
        </td>
      </tr> </table>
 
    <br>
    <table >
      <tr>
         <td ><input type="submit" value="Valider" name="btn">
         </td>
         <td ><input type="reset" value="Annuler" name="btn">
         </td>
      </tr>
      
   </table>
</form>
<?php 
include "./vue/pied.php";
?>
