    <div class="wrap">
        <h2>Create a new Quiz</h2>
        <hr />
        <?php if ( $createQuiz != FALSE ) { ?>
        <div class="updated notice">
            <p>Quiz created!</p>
            <p>You can add this Quiz by using this code: <code>[iraquiz id=<?=$createQuiz["_id"]?> /]</code></p>
        </div>
        <?php } ?>
    </div>
    <form method="post" id="create-quiz" name="create-quiz">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="quizName">Quiz Name:</label></th>
                <td><input name="quizName" type="text" id="quizName" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="quizDescription">Quiz Description:</label></th>
                <td><input name="quizDescription" type="text" id="quizDescription" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="quizQuestions">Amount of Questions:</label></th>
                <td><input name="quizQuestions" type="number" onchange="renderQuestionForm();" min="1" max="10" id="quizQuestions" class="regular-text"><br><i>(1 to 10)</i></td>
            </tr>
        </tbody>
        <tbody id="questions"></tbody>
    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Create a new Quiz">
    </p>
    </form>
    <script>
    function renderQuestionForm() {
        var numberQuestions = jQuery("#quizQuestions").val();
        var html = "";
        for (id = 0; id < numberQuestions; id++) {
            html += "<tr style=\"border-top: 2px solid black;\">\n\t\t<th scope=\"row\"><label for=\"question[" + id + "][text]\">" + (id + 1) + " Question text:</label></th>\n\t\t<td><input name=\"question[" + id + "][text]\" type=\"text\" id=\"question[" + id + "][text]\" class=\"regular-text\"></td>\n\t</tr>\n\t<tr>\n\t\t<th scope=\"row\"><label for=\"question[" + id + "][description]\">" + (id + 1) + " Question description:</label></th>\n\t\t<td><input name=\"question[" + id + "][description]\" type=\"text\" id=\"question[" + id + "][description]\" class=\"regular-text\"></td>\n\t</tr>\n\t<tr>\n\t\t<th scope=\"row\">" + (id + 1) + " Question type:</th>\n\t\t<td>\n\t\t\t<fieldset>\n\t\t\t\t<label>\n\t\t\t\t\t<input type=\"radio\" name=\"question[" + id + "][type]\" value=\"text\" checked=\"checked\">\n\t\t\t\t\tText\n\t\t\t\t</label><br>\n\t\t\t\t<label>\n\t\t\t\t\t<input type=\"radio\" name=\"question[" + id + "][type]\" value=\"textarea\">\n\t\t\t\t\tTextarea\n\t\t\t\t</label><br>\n\t\t\t\t<label>\n\t\t\t\t\t<input type=\"radio\" name=\"question[" + id + "][type]\" value=\"radio\">\n\t\t\t\t\tRadio\n\t\t\t\t</label><br>\n\t\t\t\t<label>\n\t\t\t\t\t<input type=\"radio\" name=\"question[" + id + "][type]\" value=\"check\">\n\t\t\t\t\tCheck\n\t\t\t\t</label><br>\n\t\t\t\t<label>\n\t\t\t\t\t<input type=\"radio\" name=\"question[" + id + "][type]\" value=\"file\">\n\t\t\t\t\tFile Upload\n\t\t\t\t</label><br>\n\t\t\t</fieldset>\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<th scope=\"row\"><label for=\"question[" + id + "][answer]\">" + (id + 1) + " Amount of answers:</label></th>\n\t\t<td><input name=\"question[" + id + "][answer]\" type=\"number\" min=\"1\" max=\"5\" id=\"question[" + id + "][answer]\" onchange=\"renderAnswerFrom(" + id + ");\" class=\"regular-text\"><br><i>(1 to 5)</i></td>\n\t</tr>\n\t<tr>\n\t\t<th scope=\"row\"><label for=\"question[" + id + "][answer]\">" + (id + 1) + " Answers:</label></th>\n\t\t<td><div id=\"answers[" + id + "]\"></div></td>\n\t</tr>";
        }
        jQuery("#questions").delay(100).html(html);
    }

    function renderAnswerFrom (id) {
        var numberAnswers = jQuery("[id='question\["+id+"\]\[answer\]']").val();
        var html = "";
        for (i = 0; i < numberAnswers; i++) {
            html += '<p><strong><label for="question['+(id)+'][answer]['+i+']">Answer #'+(i+1)+': </label></strong></p>';
            html += '<input name="question['+(id)+'][answer]['+i+']" type="text" id="question['+(id)+'][answer]['+i+']" class="regular-text">';
        }
        jQuery("[id='answers\["+id+"\]']").delay(100).html(html);
    }
    </script>