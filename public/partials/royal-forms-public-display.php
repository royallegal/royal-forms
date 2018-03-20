<input type="hidden" class="quiz_total" value="<?=$form_total?>" />
<div class="container quiz-container">
    <div class="row startpage">
        <div class="col m8">
            <h1 class="quiz-title"><?=$form_name?></h1>
            <hr class="quiz-under-line" />
            <h3 class="quiz-subtitle"><?=$form_description?></h3>
            <button class="btn-quiz-toggle start">TAKE THE QUIZ</button>
        </div>
        <div class="col m4 image-area">
            <img src="<?=bloginfo('template_url'); ?>/img/quizicon-form.jpg" border="0" />
        </div>
    </div>

    <?php
        $index = 1;
        foreach ($form as $question) {
            if ( $index == $form_total ) $goto = "access";
            if ( $index != $form_total ) {
                $goto = $index+1;
                $backto = $index-1;
            }
    ?>
    <div class="question" id="quiz<?=$index?>">
        <div class="info">
            <?php if ($index>1) { ?> <span class="back backto-<?=$backto?>"></span> <?php } ?>
            Question <?=$index?> of <?=$form_total?>
        </div>
        <h2><?=$question["question"]?></h2>
        <?php if ($question["description"]): ?>
        <h4><?=$question["description"]?></h4>
        <?php endif; ?>
        <ul class="options">

            <!-- RADIO INPUT -->
            <?php if ($question["type"] == "radio") { ?>
            <?php foreach ($question["answers"] as $answer) { ?>
            <li class="goto-<?=$goto?>"><?=$answer?></li>
            <?php } ?>
            <?php } ?>

            <!-- CHECK INPUT -->
            <?php if ($question["type"] == "check") { ?>
            <?php foreach ($question["answers"] as $answer) { ?>
            <li><?=$answer?></li>
            <?php } ?>
            <?php } ?>
            <?php if ($question["type"] == "check") { ?>
            <button class="btn-quiz-toggle goToNext goto-<?=$goto?>">Next!</button>
            <?php } ?>

            <!-- INPUT INPUT -->
            <?php if ($question["type"] == "text") { ?>
            <?php foreach ($question["answers"] as $answer) { ?>
            <p><strong><label for="an-ASD"><?=$answer?>:</label></strong></p>
            <input type="text" name="an-ASD" id="an-" />
            <?php } ?>
            <?php } ?>
            <?php if ($question["type"] == "text") { ?>
            <button class="btn-quiz-toggle goToNext goto-<?=$goto?>">Next!</button>
            <?php } ?>

            <!-- TEXTAREA INPUT -->
            <?php if ($question["type"] == "textarea") { ?>
            <?php foreach ($question["answers"] as $answer) { ?>
            <p><strong><label for="an-ASD"><?=$answer?>:</label></strong></p>
            <textarea type="text" name="an-ASD" id="an-"></textarea>
            <?php } ?>
            <?php } ?>
            <?php if ($question["type"] == "textarea") { ?>
            <button class="btn-quiz-toggle goToNext goto-<?=$goto?>">Next!</button>
            <?php } ?>

            <!-- FILE INPUT -->
            <?php if ($question["type"] == "file") { ?>
            <?php foreach ($question["answers"] as $answer) { ?>
            <p><strong><label for="an-ASD"><?=$answer?>:</label></strong></p>
            <input name="myFile" type="file">
            <?php } ?>
            <?php } ?>
            <?php if ($question["type"] == "file") { ?>
            <button class="btn-quiz-toggle goToNext goto-<?=$goto?>">Upload & Next!</button>
            <?php } ?>

        </ul>
    </div>
    <?php $index++; } ?>

    <div class="form question access">
        <div class="info">
            Congratulations
        </div>
        <h2>Your report is ready to download!</h2>
        <p>Get your custom report on how to optimize your assets, taxes, retirement and estate. Just let us know where to send it.</p>
        <form>
            <input type="text" placeholder="Name" class="name" name="name" id="name" />
            <input type="email" placeholder="Email address" class="email" name="email" id="email" />
            <button class="btn-quiz-toggle sendme">Yes, send my quiz results!</button>
            <p><small>When you sign up, we'll occassionally send you emails.</small></p>
        </form>
    </div>

    <div class="form question confirm">
        <div class="info">
            There's one more thing...
        </div>
        <h2>Confirm your email</h2>
        <p>Check your email for our confirmation link</p>
        <center><img src="<?=bloginfo('template_url'); ?>/img/quizicon-confirm.jpg" class="confirm" border="0" /></center>
        <button class="btn-quiz-toggle">Click to Confirm</button>
    </div>
</div> 