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
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <select name="language" id="selectedLanguage">
        <?php getLanguageOptions() ?>
    </select>

    <select name="translationLanguage" id="selectedTranslationLanguage">
        <?php getLanguageOptions() ?>
    </select><br>

    <div style="display: flex;">

        <div id="newWordBox">
            <input class="textInput" id="newWord" name="word" placeholder="Nové slovo" autocomplete="off"></input>

            <div class="dropdown" style="display: none">
                <div class="item"><p>Vyhledávání</p></div>
            </div>

            <!--
                <select name="language"><?php getWordOptions() ?></select>
            -->
        </div>

        <div>
            <input class="textInput" id="translation" name="translation" placeholder="Překlad" autocomplete="off"></input>
        </div>

        <button class="button" onclick="createTranslation()">Přidat</button>

    </div>
    
</body>
</html>

<script>

$(document).click(function(event) { 
    var $target = $(event.target);

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
            console.log();
            dropdown.append('<div class="item"><p>' + word.word + '</p></div>');
        });

    });
    /*
    dropdown.append('<div class="item"><p>Auto</p></div>');
    dropdown.append('<div class="item"><p>Franta</p></div>');
    dropdown.append('<div class="item"><p>Židle</p></div>');
    */
});

function createTranslation() {

    var langId = $('#selectedLanguage').val();
    var translationLangId = $('#selectedTranslationLanguage').val();
    
    var newWord = $('#newWord').val();
    var translation = $('#translation').val();

    $.post( "addWord.php", { langId: langId, translationLangId: translationLangId, word: newWord, translation: translation }).done(function( data ) {

        alert(data);

    });

}

</script>