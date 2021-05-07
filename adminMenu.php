<?php require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');

reqlib('database');
reqlib('language');

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="dropDownController.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="dropDown.css">
</head>
<body>

<div class="menu">
    <p class="heading">Správa administrátora</p>
    <a class="button">Hello</a>
    <a class="button">World</a>
</div>

<div class="center-strip">
<div class="center-content">

    <p class="heading">Administrativní správa</p>

    <table style="width:100%; color: white;">
    <tr>
        <td>
            <div class="custom-select" style="width:200px; margin: 4px;">
            <select name="language" id="selectedLanguage">
                <?php getLanguageOptions() ?>
            </select>
            </div>
        </td>
        <td style="text-align: center;">
            <div class="icon-button" onclick="swapLanguages()">
                <i class="fas fa-retweet"></i>
            </div>
        </td>
        <td>
            <div class="custom-select" style="width:200px; margin: 4px;">
                <select name="translationLanguage" id="selectedTranslationLanguage">
                    <?php getLanguageOptions() ?>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div id="newWordBox" style="padding: 6px;">
                <input class="textInput" id="newWord" name="word" placeholder="Nové slovo" autocomplete="off" spellcheck="false"></input>

                <div class="dropdown" style="display: none">
                    <div class="item"><p>Vyhledávání</p></div>
                </div>
            </div>
        </td>
        <td></td>
        <td>
            <div style="padding: 6px;">
                <input class="textInput" id="translation" name="translation" placeholder="Překlad" autocomplete="off" spellcheck="false"></input>
            </div>
        </td>
    </tr>
    </table>

    <div style="display: flex;">

        
        <script>
            $('#selectedTranslationLanguage option[value=2]').attr('selected','selected');
        </script>

    </div>
    
    <br>

    <div style="display: flex; padding: 6px;">


        
    </div>
    
    <div style="position: relative; left: 50%;">
        <button style="transform: translateX(-50%);" class="button" onclick="createTranslation()">Přidat</button>
    </div>

    <div style="position: absolute; left: 50%; transform: translate(-50%, 0);">

        <p>Administrátorské akce</p>
        
        <button class="button danger" onclick="clearDatabase()">Promazat databázi</button>

    </div>

</div>
</div>
    
</body>
</html>

<script>

$(document).click(function(e) { 
    var $target = $(e.target);

    var newWordBox = $('#newWordBox');
    var dropdown = $('.dropdown');

    if ($target.closest(newWordBox).length) {
        $(dropdown).show("fast");
    } else {
        $(dropdown).hide("fast");
    }
});

$('#newWordBox').keypress(function(e) {

    var newWord = $('#newWord').val();
    var languageId = $('#selectedLanguage').val();

    var dropdown = $('.dropdown');

    $.post( "getWords.php", { word: newWord, languageId: languageId }).done(function( data ) {

        const words = JSON.parse(data);
        
        dropdown.empty();
        if (words.length == 0) {
            dropdown.append('<div class="item"><p>Žádné výsledky</p></div>');
            return;
        }
        dropdown.append('<div class="item"><p>Vyhledali jsme ' + words.length + ' ' + (words.length<5?(words.length==1?'slovo':'slova'):'slov') + '</p></div>');

        words.forEach(word => {
            var onclick = "setInputWord('newWord', $(this).html())";
            dropdown.append('<div class="item"><p onclick="' + onclick + '">' + word.word + '</p></div>');
        });

    });
});

function createTranslation() {

    var langId = $('#selectedLanguage').val();
    var translationLangId = $('#selectedTranslationLanguage').val();

    if (langId == translationLangId) {
        alert('Nelze překládat do stejného jazyku!');
        return;
    }

    var newWord = $('#newWord').val();
    var translation = $('#translation').val();
    
    if (newWord == '') {
        alert('Zadej slovo!');
        return;
    }
    if (translation == ''){
        alert('Zadej překlad!');
        return;
    }

    $.post( "addWord.php", { langId: langId, translationLangId: translationLangId, word: newWord, translation: translation }).done(function( data ) {

        if (data == 'success') {
            alert('Slovo úspěšně přidáno.');
            
            $('#newWord').val('');
            $('#translation').val('');
        } else {
            alert('Stala se chyba: ' + data);
        }

    });

}

function clearDatabase() {
    if (confirm('Opravdu chcete promazat databázi a smazat záznamy?')) {
        $.post('clearDatabase.php').done(function(data){});
    }
}

function setInputWord(inputId, text) {
    $('#' + inputId).val(text);
}

function swapLanguages() {
    var selected = $('#selectedLanguage').val();
    var target = $('#selectedTranslationLanguage').val();

    if (target == selected) return;

    /* clear all custom select childrens */
    
    $('.select-selected').remove();
    $('.select-items').remove();

    $('#selectedLanguage option').removeAttr('selected');
    $('#selectedTranslationLanguage option').removeAttr('selected');

    /* swap selects */

    $('#selectedLanguage').val(target);
    $('#selectedTranslationLanguage').val(selected);

    $('#selectedLanguage option[value='+target+']').attr('selected','selected');
    $('#selectedTranslationLanguage option[value='+selected+']').attr('selected','selected');

    /* rebuild selects */

    buildCustomSelects();
}


buildCustomSelects();
</script>
