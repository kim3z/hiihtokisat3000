<?php
    /**
     * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
     */

    include_once './layout/site_header.php';
    include_once './Database/DB.php';
    include_once './Functions/Post.php';

    $postFound = false;

    if (isset($_GET['id'])) {
        $postFound = true;

        $db = new DB();
        $pdo = $db->newConnection();
        
        Post::dbConnection($pdo);
        
        $post = Post::getPost($_GET['id']);

        if (isset($post)) {
            $author = Post::getPostAuthor($post['user_id']);
            if (isset($author)) {
                $post['author'] = $author;
                $postFound = true;
            }
        }

    }
?>

<section id="login-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <?php if($postFound) : ?>
                <div class="single-post-title-wrapper">
                    <h1 class="single-post-title"><?php echo $post['title']; ?></h1>
                </div>
                <p class="text-center"><?php echo $post['author']; ?>, <?php  echo $post['created_at']; ?></p>
                <img class="img-fluid single-post-img mb-2 mt-2" src="<?php echo 'uploads/' . $post['img']; ?>" alt="">
                <p class="lead">
                    <?php echo $post['content']; ?>
                </p>
            <?php else : ?>
                <h1>Julkaisua ei löytynyt</h1>
            <?php endif; ?>
            </div>
        </div>
    </div>
  </section>

<?php 
    include_once './layout/site_footer.php';
?>
