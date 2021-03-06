<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<?php flash("registered_successfully"); ?>
<!-- Add post Modal -->
<?php flash("post_created"); ?>
<?php flash("post_updated"); ?>
<?php flash("post_not_updated"); ?>
<?php
$display = $data['display'];
$myposts_page = $data['myposts_page'];
$count_myposts = $data['count_myposts'];
$per_myposts_page = $data['per_myposts_page'];
$myfriends_posts_page = $data['myfriends_posts_page'];
$count_myfriends_posts = $data['count_myfriends_posts'];
$per_myfriends_posts_page = $data['per_myfriends_posts_page'];
$count_myfriends_posts_for_pagination = ceil($count_myfriends_posts/$per_myfriends_posts_page);
$count_myposts_for_pagination = ceil($count_myposts/$per_myposts_page);
if(is_int($myposts_page) && is_int($myposts_page) && is_int($myfriends_posts_page) && is_int($myfriends_posts_page)){
$back_myposts = $myposts_page - 1;
$for_myposts = $myposts_page + 1;
$back_myfriends_posts = $myfriends_posts_page - 1;
$for_myfriends_posts = $myfriends_posts_page + 1;
}else{
	
}
?>
<div role="main" class="container" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-3 mt-2" style="position:fixed;">
		<?php require APPROOT . '/views/inc/sidebar.php'; ?>
		<div class="modal fade" id="add-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		</div>
	</div>
		<div class="col-md-8 offset-md-4 mt-4">
			<form action="<?php echo URLROOT ; ?>/searchs/searchMyFriendsPosts" method="post" class="">
        <div class="input-group input-group-sm">
        <input type="text" class="form-control" name="search_content_myfriends_posts" placeholder="Search for my friends posts">
        <div class="input-group-append">
        <button type="submit" name="search_myfriends_posts" class="input-group-text"><i class="fa fa-search"></i></button></div>
        </div>
      </form><br>
			<?php foreach($data['myfriends_posts'] as $myfriends_posts): ?>
				<div class="card mb-4">
					<?php
                if ($myfriends_posts->post_image):
                $post_user = $user->findUserById($myfriends_posts->post_user_id);
                $post_user_name = $post_user->user_name;
                ?><img class='card-img-top' style="width:100%" src="<?php echo URLROOT . "/images/posts_images/" . $post_user_name .  "_images/" . $myfriends_posts->post_image ?>" alt='Card image cap'>
				<div class="card-body">
	              <h2 class="card-title"><?php echo $myfriends_posts->post_title ?></h2>
	              <p class="card-text"><?php echo $myfriends_posts->post_content; ?></p>
	      			<?php
					$likes = new Likes();
					$dislikes = new Dislikes();
					$post = new Posts();
					$user = new Users();
					if($post->post_is_viewed($myfriends_posts->post_id)){
						?>
						<style type="text/css">
							.post_title{
								color : green;
							}
						</style>
						<?php
					}
					if($likes->liked($myfriends_posts->post_id)){
						?>
						<style type="text/css">
							.like_icon_<?php echo $myfriends_posts->post_id; ?>{
								color:#7c7cff;
							}
							.btn-groupp form .like_button_<?php echo $myfriends_posts->post_id; ?> {
								border-bottom: 2px solid #7c7cff;
							}
						</style>
						<?php
					}else{
						?>
						<style type="text/css">
							.like_icon_<?php echo $myfriends_posts->post_id; ?> {
							  color: grey;
							}
							.btn-groupp form .like_button_<?php echo $myfriends_posts->post_id; ?> {
							  border-bottom: 2px solid grey;
							}
						</style>
						<?php	
					}
					if($dislikes->disliked($myfriends_posts->post_id)){
						?>
						<style type="text/css">
							.dislike_icon_<?php echo $myfriends_posts->post_id; ?>{
								color:#ff7a7a;
							}
							.btn-groupp form .dislike_button_<?php echo $myfriends_posts->post_id; ?> {
								border-bottom: 2px solid #ff7a7a;
							}
						</style>
						<?php
					}else{
						?>
						<style type="text/css">
							.dislike_icon_<?php echo $myfriends_posts->post_id; ?> {
							  color: grey;
							}
							.btn-groupp form .dislike_button_<?php echo $myfriends_posts->post_id; ?> {
							  border-bottom: 2px solid grey;
							}
						</style>
						<?php	
					}
					?></div><div class="card-footer">
					<div class="d-flex justify-content-between">
  <div class="p-2"><form action="<?php echo URLROOT . "/likes/likePost/" . $myfriends_posts->post_id; ?>" onsubmit="return likeSubmit();">
								<button class="btn like_button_<?php echo $myfriends_posts->post_id; ?> like_button_hover" style="padding-top:0px;padding-bottom:0px;"><i class="fas fa-hand-holding-heart like_icon_<?php echo $myfriends_posts->post_id; ?> like_icon_hover" style="margin-left: -12px;padding-bottom: 2px;"><span style="margin-left:2px;"><?php echo $myfriends_posts->post_likes_count; ?> feel better<?php
								if($myfriends_posts->post_likes_count>1){
									echo "s";
								}
								?></span></i></button>
							</form></div>
  <div class="p-2">3 comments</div>
  <div class="p-2"><?php echo $myfriends_posts->post_date; ?></div>
  <div class="p-2">posted by: <?php echo $myfriends_posts->post_author; ?></div>
</div></div>
							
				<?php endif; ?></div><br>
			<?php endforeach; ?>
		</div>
	</div></div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>