    <div class="wrap">
        <h2>Create a new form</h2>
        <hr />
        <?php if ( $form_create != FALSE ) { ?>
        <div class="updated notice">
            <p>Form created!</p>
            <p>You can add this Form by using this code: <code>[royalform id=<?=$form_create["_id"]?> /]</code></p>
        </div>
        <?php } ?>
    </div>
    <form method="post" id="create-quiz" name="create-quiz">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="formName">Form Name:</label></th>
                <td><input name="formName" type="text" id="formName" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="formDescription">Form Description:</label></th>
                <td><input name="formDescription" type="text" id="formDescription" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="formTheme">Form Template:</label></th>
                <td>
                    <select name="config[formTheme]">
                        <option disabled>Select a template</option>
                        <option value="0">Default</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="formTheme">Intro Template:</label></th>
                <td>
                    <select name="config[formTheme]">
                        <option disabled>Select a template</option>
                        <option value="0">Default</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="formTheme">Thank You Template:</label></th>
                <td>
                    <select name="config[formTheme]">
                        <option disabled>Select a template</option>
                        <option value="0">Default</option>
                    </select>
                </td>
            </tr>
            <?php
            $config_elements = [
                "Mailchimp API Key" => "mailchimp",
                "Highly extensible" => "filedkey",
                "Redirect URL?" => "redirect",
            ];
            foreach ($config_elements as $text => $field) { ?>
            <tr>
                <th scope="row"><label for="config[field][<?=$field?>]"><?=$text?>:</label></th>
                <td><input name="config[field][<?=$field?>]" type="text" id="config[field][<?=$field?>]" class="regular-text"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <table id="questions" class="form-table"></table>
    <hr />
    <p class="submit">
        <a name="addquestion" id="addquestion" onclick="addQuestion(); return false;" style="margin-right:2em; text-decoration:underline; cursor:pointer;">Add a new question</a>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Create a New Form" style="display:none">
    </p>
    </form>
    <script>
    var id = 0;
    var qid = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,23,23,24,25];

    function renderQuestion(id) {
        var html = "";
        html = ' \
        <tbody id="question-'+id+'"> \
        <tr style="border-top: 2px solid #666;"> \
            <th scope="row"> \
                <label for="question[' + id + '][text]">Question text:</label> \
            </th> \
            <td> \
                <input name="question[' + id + '][text]" type="text" id="question[' + id + '][text]" class="regular-text"> \
            </td> \
        </tr> \
        <tr> \
            <th scope="row"> \
                <label for="question[' + id + '][description]">Question description:</label> \
            </th> \
            <td> \
                <input name="question[' + id + '][description]" type="text" id="question[' + id + '][description]" class="regular-text"> \
            </td> \
        </tr> \
        <tr> \
            <th scope="row">Question type:</th> \
            <td> \
                <select name="question[' + id + '][type]"> \
                    <option value="text">Text</option> \
                    <option value="textarea">Textarea</option> \
                    <option value="radio">Radio</option> \
                    <option value="check">Check</option> \
                    <option value="file">File Upload</option> \
                </select> \
            </td> \
        </tr> \
        <tr> \
            <th scope="row"> \
                <label for="question[' + id + '][answer]"></label> \
            </th> \
            <td> \
                <input type="button" onclick="addAnswerField(' + id + ')" class="button button-secondary" value="+ Add answer" /> \
            </td> \
        </tr> \
        <tr> \
            <th scope="row"> \
                <label for="question[' + id + '][answer]">Answers / Options:</label> \
            </th> \
            <td> \
                <div id="answers[' + id + ']"></div> \
            </td> \
        </tr> \
        <tr> \
            <th scope="row"> \
                <input type="button" onclick="removeQuestion(' + id + '); return false;" class="button  button-secondary" value="X Remove this question" /> \
            </th> \
        </tr> \
        </tbody>';
        return html;
    }

    function addQuestion () {
        var html = renderQuestion(id);
        id++;
        jQuery("#questions").append(html);
        jQuery("#submit").fadeIn();
    }

    function removeQuestion (id) {
        jQuery("#question-"+id).remove();
    }

    function addAnswerField (id) {
        var i = qid[id];
        var html = "";
        html += '<p id="ans-'+id+'-'+i+'"><strong><label for="question['+(id)+'][answer]['+i+']">Answer: </label></strong>';
        html += '<input name="question['+(id)+'][answer]['+i+']" type="text" id="question['+(id)+'][answer]['+i+']" class="regular-text"> <a href="#" onclick="removeAnswerField('+id+', '+i+'); return false;">X</a> </p>';
        jQuery("[id='answers\["+id+"\]']").append(html);
        qid[id]++;
    }

    function removeAnswerField (id, fieldId) {
        jQuery("#ans-"+id+"-"+fieldId).remove().fadeOut();
    }

    </script>