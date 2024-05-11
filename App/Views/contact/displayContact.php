<?php 
use App\Core\Translation;
?>
<div class="container-contact-page">
    <div class="introduce-contact-page">
        <h1><?=Translation::get("Come and Say Hi!")?></h1>
        <h2><?=Translation::get("I am always up for a chat. Feel free to reach out to me.")?></h2>
    </div>
    <div class="form-container">
        <form action="index.php?controller=contact&action=formSubmitted" method="POST">
            <input type="hidden" name="csrf_token" value="<?php $csrf_token; ?>">
            <label for="name"><?=Translation::get("Your name")?></label>
            <input type="text" name="name" placeholder="<?=Translation::get("John Doe")?>">
            <label for="email"><?=Translation::get("Your email")?></label>
            <input type="email" name="email" placeholder="<?=Translation::get("example@example.com")?>">
            <label for="message"><?=Translation::get("Your message")?></label>
            <textarea name="message" cols="30" rows="10" placeholder="<?=Translation::get("Leave a comment..")?>"></textarea>
            <button type="submit"><?=Translation::get("Send message")?></button>
        </form>
    </div>
</div>