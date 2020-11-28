<?php
include("helpers/header.php");
include("helpers/user.php");
include("helpers/post.php");




if(isset($_POST['post'])){
    $post = new Post($conn, $user_logged_in);
    $post -> submitPost($_POST['post_text']);
    header("Location: index.php");
}

?>

<div class = "news_feed column">
    <form class = "post_feed" action = "index.php" method = "POST">
        <textarea name = "post_text" id = "post_text" placeholder = "What's on your mind?"></textarea>
        <input type = "submit" name = "post" id = "post_button" value = "Post"> 
        <hr>

    </form>

    <?php
        $post = new Post($conn, $user_logged_in);
        $post->loadPost();
    ?>

</div>


</body>
</html>