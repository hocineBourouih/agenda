<!doctype html>
<html lang="fr">
<head>
  <title>Agenda</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="form.css"  type="text/css" >
</head>
<body>
  <h1>Agenda</h1>
  <hr>
  <table class="tabM">
  <tr>
    <td class="tdM"><?php  echo $zonePrincipale; ?>  </td>
    <td style="background-color:silver;">
      <p>
        <a href="index.php?action=insert">Ajouter une personne</a><br>
        <a href="index.php?action=liste">Liste de personne(s)</a><br >
      </p>
    </td>
  </tr>
  </table>
  <hr>
</body>
</html>
