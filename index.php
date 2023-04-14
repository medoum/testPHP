<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvel utilisateur</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group">
            <label for="nom" class="form-label my-2">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
            </div>

            <div class="form-group">
            <label for="email" class="form-label my-2">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Entrez votre email">
            </div>

            <div class="form-group">
            <label for="tel" class="form-label my-2">Tel</label>
            <input type="text" class="form-control" id="tel" placeholder="Entrez votre numero de telephone">
            </div>

            <div class="form-group">
            <label for="adresse" class="form-label my-2">Adresse</label>
            <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse">
            </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-dark" onclick="adduser()">Enregistrer</button>
      </div>
    </div>
  </div>
</div>
  <!-- update modal -->

  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modication d'utilisateur</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group">
            <label for="updatename" class="form-label my-2">Nom</label>
            <input type="text" class="form-control" id="updatename" placeholder="Entrez votre nom">
            </div>

            <div class="form-group">
            <label for="updateemail" class="form-label my-2">Email</label>
            <input type="email" class="form-control" id="updateemail" placeholder="Entrez votre email">
            </div>

            <div class="form-group">
            <label for="updatetel" class="form-label my-2">Tel</label>
            <input type="text" class="form-control" id="updatetel" placeholder="Entrez votre numero de telephone">
            </div>

            <div class="form-group">
            <label for="updateadresse" class="form-label my-2">Adresse</label>
            <input type="text" class="form-control" id="updateadresse" placeholder="Entrez votre adresse">
            </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        <input type="hidden" id="hiddendata">
        <button type="button" class="btn btn-dark" onclick="updateUser()" >Modifier</button>
      </div>
    </div>
  </div>
</div>


<div class="container my-3">
    <h1 class="text-center">PHP CRUD OPERATIONS</h1>
    <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal">
  Ajouter un nouvel utilisateur
</button>
<div id="displayDataTable"></div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>

  $(document).ready(function(){
    displayData();
  });
    // Afficher les informations
    function  displayData(){
        var displayData = "true";

        $.ajax({
            url: "display.php",
            type: "post",
            data: {
                displaySend:displayData
            },
            success:function(data, status){
                $('#displayDataTable').html(data);
            }
        })
    }

    // Ajouter un nouvel utilisateur
    function adduser(){
        var nameAdd = $('#nom').val();
        var emailAdd = $('#email').val();
        var telAdd = $('#tel').val();
        var adresseAdd = $('#adresse').val();

        $.ajax({
            url: "insert.php",
            type: "post",
            data:{
                nameSend: nameAdd,
                emailSend: emailAdd,
                telSend: telAdd,
                adresseSend: adresseAdd
            },
            success: function(data,status){
                // Afficher les informations
                // console.log(status);
                $('#completeModal').modal('hide');
                displayData();
            }
        });
    }

    // Supprimer un utilisateur
    function DeleteUser(deleteid){
      $.ajax({
        url: "delete.php",
        type: 'post',
        data:{
          deleteSend:deleteid
        },
        success: function(data, status){
          displayData();
        }
      });

    }

    // Modifier un utilisateur

    function UpdateUser(updateid){
      $('#hiddendata').val(updateid);

      $.post("update.php", {updateid:updateid}, function(data,status){
          var userid = JSON.parse(data);
          $('#updatename').val(userid.nom)
          $('#updateemail').val(userid.email)
          $('#updatetel').val(userid.tel)
          $('#updateadresse').val(userid.adresse)

      });
      $('#updateModal').modal("show");
    }

    // onclick update event function
    function updateUser(){
      var updatename=$('#updatename').val();
      var updateemail=$('#updateemail').val();
      var updatetel=$('#updatetel').val();
      var updateadresse=$('#updateadresse').val();
      var hiddendata = $('#hiddendata').val();

      $.post("update.php",{
        updatename:updatename,
        updateemail:updateemail,
        updatetel:updatetel,
        updateadresse:updateadresse,
        hiddendata:hiddendata
},function(data,status){
  $('#updateModal').modal('hide');
  displayData()
});
}

</script>
</body>
</html>