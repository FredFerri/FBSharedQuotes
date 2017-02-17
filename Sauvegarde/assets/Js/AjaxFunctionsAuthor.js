$(document).ready(function() {
    
    var url = window.location.href;
    var page = document.location.pathname.match(/[^\/]+$/)[0];
    var page = page.replace('.php', '');


    $('input[name="submit"]').click(function(e) {
        e.preventDefault();
        var empty = 0;
        $(".main-form .required").each(function(){
            if ($.trim($(this).val()).length == 0){
                empty ++;
            }
        });
        if (empty >= 1) {
            alert("Veuillez remplir tous les champs");
            $('.form-block').prepend("<div><p class='error-message' style='color: red;'>Veuillez remplir tous les champs contenant un *</p></div>");
            setTimeout(function() {$('.error-message').hide('slow')}, 4000);
        }
    });

    $('input[name="submit_hidden"]').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var empty = 0;
        $("tr[id="+id+"].required").each(function(){
            if ($.trim($(this).val()).length == 0){
                empty ++;
            }
        });
        if (empty >= 1) {
            alert("Veuillez remplir tous les champs");
            $('.form-block').prepend("<div><p class='error-message' style='color: red;'>Veuillez remplir tous les champs contenant un *</p></div>");
            setTimeout(function() {$('.error-message').hide('slow')}, 4000);
        }
    });


            $('.btn-edit').click(function(e) {
                e.preventDefault();
                $('.btn-edit, .btn-delete').toggle();
                $(this).parent().parent().toggle();
                $(this).parent().parent().next().toggle();
            });
            
            $('.btn-cancel').click(function() {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
            });
            
            
            $('#add').click(function(e) {
                e.preventDefault();
                //$('.btn-edit, .btn-delete').toggle();
                var name = $('#name').val();
                var firstname = $('#firstname').val();
                var list = [];
                    $('select option:selected').each(function() {
                        var category_id = $(this).attr('id');
                        var values = category_id.split('-');
                        var category = values[1];
                        list.push(category);
                    });
                var category = list.toString();

                var biography = $('#biography').val();
                var country = $('#country').val();
                var birthdate = $('#birthdate').val();
                var deathdate = $('#deathdate').val();
                
                
                $.post(
                
                'backend/treatment.php',
                
                { 
                    
                authName: name,
                
                authFirstname : firstname,
                
                authCategoryId : category,
                
                authBiography : biography,
                
                authCountry : country,
                
                authBirthdate : birthdate,
                
                authDeathdate : deathdate

                },
                
                
                
                
                function refreshDatas(data) {
                    
                    alert(data);
                    
                }
                )
            });

            $('#addCat').click(function(e) {
                e.preventDefault();
                var cat = $('input[name="category"]').val();

                $.post(

                    'backend/treatment.php',

                    { category: cat },

                    function refreshDatas(data) {

                        $('.list-block tbody').prepend('<p style="color: green;">Catégorie ajoutée !</p>');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    }
                )
            });
            
            
            $('#addQuote').click(function(e) {
                e.preventDefault();
                //$('.btn-edit, .btn-delete').toggle();
                var list = [];
                    $('select option:selected').each(function() {
                        var category_id = $(this).attr('id');
                        var values = category_id.split('-');
                        var author = values[1];
                        list.push(author);
                    });
                var author = list.toString();
                var author_id = author.replace(/[^0-9]/g, '');

                var quote = $('#quote').val();
                var source = $('#source').val();
                var date = $('#date').val();
                                
                $.ajax({
                    type: 'POST',
                    url: 'backend/treatment.php',
                    data: {author: author_id, quote: quote, source: source, date: date},
                    dataType: 'json',
                    success: function(result) {

                        alert(result);
                        
                        var id = result['id'];
                        var author = result[5];
                        var quote = result['content'];
                        var source = result['source'];
                        var date = result['date'];

                        $('tr:last-child').after('<tr id="'+id+'" class="row-visible"><td>'+id+'</td><td id="author-'+author_id+'">'+author+'</td><td id="quote-'+id+'">'+quote+'</td><td id="source-'+id+'">'+source+'</td><td id="date-'+id+'">'+date+'</td><td><a class="btn-edit" href="#">Modifier</a></td><td><a id="delete-'+id+'" class="btn-delete" href="#">Supprimer</a></td></tr>');
                    }
                })
            });
            
            $('#addUser').click(function(e) {
                e.preventDefault();
                $('.btn-edit, .btn-delete').toggle();
                

                var pseudo = $('#pseudo').val();
                var password = $('#password').val();
                
                if (password.length < 6) {
                    alert('Votre mot de passe doit contenir au moins 6 caractères');
                }
                else {

                $.post(
                
                'backend/treatment.php',
                
                { 
                    
                pseudo: pseudo,
                
                password : password

                },
                
                
                function refreshDatas(data) {
                    
                    alert(data);
                    
                }
                )}
            });

            
            $('.edit-cat').click(function(e) {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
                e.preventDefault();

                    
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
            });
            
            $('.edit-author').click(function(e) {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
                e.preventDefault();
                    
                    var identifiant = $(this).attr('id');
                    var lastname = $('#lastname_'+identifiant).val();
                    var firstname = $('#firstname_'+identifiant).val();
                    var cat = $('#cat_'+identifiant).val();
                    var biography = $('#biography_'+identifiant).val();
                    var country = $('#country_'+identifiant).val();
                    var birthdate = $('#birthdate_'+identifiant).val();
                    var deathdate = $('#deathdate_'+identifiant).val();
                    
                    $.post(
                        'backend/treatment.php',
                        {
                            newLastname : lastname,
                            
                            id : identifiant,
                            
                            newFirstname : firstname,
                            
                            newCategory : cat,
                            
                            newBiography : biography,
                            
                            newCountry : country,
                            
                            newBirthdate : birthdate,
                            
                            newDeathdate : deathdate
                        },
                        
                    function refreshDatas(data) {
                        alert(data);
                    }
                    
                    )
            });
            
            $('.edit-quote').click(function(e) {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
                e.preventDefault();
                    
                    var identifiant = $(this).attr('id');
                    var author = 28;
                    var quote = $('#quoteName_'+identifiant).val();
                    var source = $('#sourceName_'+identifiant).val();
                    var date = $('#dateName_'+identifiant).val();

                    
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url : 'backend/treatment.php',
                        data: {
                            newAuth : author,
                            
                            newQuote : quote,
                            
                            id : identifiant,
                                                        
                            newSource : source,
                            
                            newDate : date

                        },
                        
                        success: function refreshDatas(data) {
                        
                            $('#'+identifiant).empty().prepend('<td>'+data["id"]+'</td><td id="author-'+data["id"]+'">'+data[5]+' '+data[6]+'</td><td id="quote-'+data["id"]+'">'+data["content"]+'</td><td id="source-'+data["id"]+'">'+data["source"]+'</td><td id="date-'+data["id"]+'">'+data["date"]+'</td><td><a class="btn-edit" href="#" style="">Modifier</a></td><td><a id="delete-'+data["id"]+'" class="btn-delete" href="#" style="">Supprimer</a></td>');
                            $('#'+identifiant).next().empty().prepend('<td>'+data["id"]+'</td><td id="author-'+data["id"]+'">'+data[5]+' '+data[6]+'</td><td id="quote-'+data["id"]+'">'+data["content"]+'</td><td id="source-'+data["id"]+'">'+data["source"]+'</td><td id="date-'+data["id"]+'">'+data["date"]+'</td><td><a class="btn-edit" href="#" style="">Modifier</a></td><td><a id="delete-'+data["id"]+'" class="btn-delete" href="#" style="">Supprimer</a></td>');
                    }
                    
                    })
            });
            
            $('.edit-user').click(function(e) {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
                e.preventDefault();
                if ($('.list-block .required').val()=='') {
                    alert('Veuillez remplir tous les champs obligatoires');
                }
                
                var identifiant = $(this).attr('id');
                var user = $('#userName_'+identifiant).val();

                if ($('.edit-password').val().length>=6) {
                    var password = $('#userPassword_'+identifiant).val();
                }
                else {
                    var password = null;
                }
                                                
                    $.post(
                        'backend/treatment.php',
                        {
                            newPseudo : user,
                            
                            newPassword : password,
                            
                            id : identifiant
                        },
                        
                        
                    function refreshDatas(data) {
                        $('#name-'+identifiant).empty().prepend(data);
                    }
                    
                    )
                }
            );
            
            $('.btn-delete').click(function () {
                var identifiant = $(this).attr('id');
                var values = identifiant.split('-');
                var identifiant = values[1];
                alert(page);
                if (confirm('Êtes vous sûr de vouloir supprimer cet élément ?')) {

                    $.post(
                        'backend/treatment.php',

                        {
                            idRemove : identifiant,
                            
                            page : page
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
            });
            
            $('#login').click(function() {
                var pseudo = $('#log_pseudo').val();
                var password = $('#log_password').val();

                $.post(
                    'backend/treatment.php',
                    
                    {
                        log_pseudo : pseudo,
                        
                        log_password : password
                    },
                    
                    function refreshDatas(data) {
                        alert(data);
                    }
                )
            })

    });
