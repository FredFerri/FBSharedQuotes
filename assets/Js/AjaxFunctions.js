$(document).ready(function() {

    var url = window.location.href;
    var page = document.location.pathname.match(/[^\/]+$/)[0];
    var page = page.replace('.php', '');


    /* Message d'erreur si des champs requis ne sont pas completés */

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


    /* Animation au click sur les boutons "modifier" et "annuler" */

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


    /* Ajout d'un auteur */

            $('#add').click(function(e) {
                e.preventDefault();
                //$('.btn-edit, .btn-delete').toggle();
                var name = $('#name').val();
                var firstname = $('#firstname').val();
                var category = $('#category').val();
                var biography = $('#biography').val();
                var country = $('#country').val();
                var birthdate = $('#birthdate').val();
                var deathdate = $('#deathdate').val();


                $.post(

                'backend/treatment.php',

                {

                authName: name,

                authFirstname : firstname,

                authCategory : category,

                authBiography : biography,

                authCountry : country,

                authBirthdate : birthdate,

                authDeathdate : deathdate

                },

                function refreshDatas(data) {

                    if (data=='OK') {
                        location.reload();

                    }
                    else {
                        alert(data);
                    }

                }
                )
            });


    /* Ajout d'une citation */

            $('#addQuote').click(function(e) {
                e.preventDefault();
                //$('.btn-edit, .btn-delete').toggle();

                var author = $('#auth-quote').val();
                var quote = $('#quote').val();
                var source = $('#source').val();
                var date = $('#date').val();

                $.post(

                    'backend/treatment.php',

                    {
                        author: author,

                        quote: quote,

                        source: source,

                        date: date

                    },

                    function refreshData(data) {

                        if (data=='OK') {
                            location.reload();
                        }
                        else {
                            alert(data);
                        }

                    }
                )
            });



    /* Ajout d'un user */

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
                    location.reload();

                }
                )}
            });


    /* Modification d'un auteur */

    $('.edit-author').click(function(e) {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
                e.preventDefault();

                    var identifiant = $(this).attr('id');
                    var lastname = $('#h-lastname_'+identifiant).val();
                    var firstname = $('#h-firstname_'+identifiant).val();
                    var cat = $('#h-category_'+identifiant).val();
                    var biography = $('#h-biography_'+identifiant).val();
                    var country = $('#h-country_'+identifiant).val();
                    var birthdate = $('#h-birthdate_'+identifiant).val();
                    var deathdate = $('#h-deathdate_'+identifiant).val();

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
                        if (data=='OK') {
                            location.reload();
                        }
                        else {
                        alert(data);
                        }
                    }

                    )
            });


    /* Modification d'une citation */

    $('.edit-quote').click(function(e) {
                $(this).parent().parent().toggle();
                $(this).parent().parent().prev().toggle();
                $('.btn-edit, .btn-delete').toggle();
                e.preventDefault();

                    var identifiant = $(this).attr('id');
                    var author = $('#authName_'+identifiant).val();
                    var quote = $('#quoteName_'+identifiant).val();
                    var source = $('#sourceName_'+identifiant).val();
                    var date = $('#dateName_'+identifiant).val();


                $.post(

                    'backend/treatment.php',

                    {
                        newAuthor: author,

                        newQuote: quote,

                        newSource: source,

                        newDate: date,

                        id : identifiant

                    },

                    function refreshData(data) {

                        if (data=='OK') {
                            location.reload();
                        }
                        else {
                            alert(data);
                        }

                    }
                )
            });


    /* Modification d'un user */

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
                        if (data=='OK') {
                            location.reload();
                        }
                        else {
                            alert(data);
                        }
                    }

                    )
                }
            );


    /* Suppression */

    $('.btn-delete').click(function () {
                var identifiant = $(this).attr('id');
                var values = identifiant.split('-');
                var identifiant = values[1];
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


    /* Authentification */

            $('#login').click(function() {
                var pseudo = $('#log_pseudo').val();
                var password = $('#log_password').val();

                document.location.href = "backend/treatment.php?pseudo=" + pseudo + "&password=" + password;
            });


    });
