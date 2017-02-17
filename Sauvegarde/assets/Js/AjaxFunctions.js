$(document).ready(function() {


        $('#submit').click(function(e) {
            if ($('#category').val()=='') {
                e.preventDefault();
                $('#category').after("<div><p>Veuillez entrer un nom de catégorie</p></div>");
            }

        });

        $('.btn-edit').click(function() {
            $(this).parent().parent().toggle();
            $(this).parent().parent().next().toggle();
        });
        
        $('.btn-cancel').click(function() {
            $(this).parent().parent().toggle();
            $(this).parent().parent().prev().toggle();
        });
        
        $('#addCat').click(function(e) {
            e.preventDefault();
            var cat = $('input[name="category"]').val();
            
            $.post(
            
            'backend/treatment.php',
            
            { category: cat },
            
            function refreshDatas(data) {
                
                $('.list-block tbody').append('<p style="color: green;">Catégorie ajoutée !</p>');
                setTimeout(function() {
                    location.reload();
                }, 2000);
                
            }
            )
        });

        
        $('.btn-edit-hidden').click(function(e) {
            $(this).parent().parent().toggle();
            $(this).parent().parent().prev().toggle();
            e.preventDefault();
            if ($('.required').val()=='') {
                $('#category').after("<div><p>Veuillez remplir tous les champs obligatoires</p></div>");
            }
            else {
                
                var identifiant = $(this).attr('id');
                var catName = $('#catName_'+identifiant).val();
                
                $.post(
                    'backend/treatment.php',
                    {
                        newCat : catName,
                        
                        id : identifiant
                    },
                    
                function refreshDatas(data) {
                    $('#name-'+identifiant).empty().prepend(data);
                }
                
                )
            }
        });
        
        $('.btn-delete').click(function () {
            var identifiant = $(this).attr('id');
            var values = identifiant.split('-');
            var identifiant = values[1];
            if (confirm('Êtes vous sûr de vouloir supprimer cet élément ?')) {

                $.post(
                    'backend/treatment.php',

                    {
                        idRemove : identifiant
                    },

                    function refreshDatas(data) {
                        if (data=='OK') {
                            $('#'+identifiant).remove();
                        }
                        else {
                            alert('Erreur lors de la suppression');
                        }
                    }
                )

            }
        })

});