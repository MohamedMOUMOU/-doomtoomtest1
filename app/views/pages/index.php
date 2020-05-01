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
<div role="main" class="container-fluid" style="margin-top: 70px;">
	<div class="row">
		<div class="col-md-3 scroll-sidebar1" style="overflow: hidden;height: 87vh;">	
		<?php require APPROOT . '/views/inc/sidebar1.php'; ?>
	</div>
		<div class="col-md-6 offset-md-3 mb-3">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
			<li class="nav-item">
			<?php if($data['display'] == 'search'): ?>
			<a href="<?php echo URLROOT; ?>/pages/index/<?php echo $myposts_page; ?>/1/search" style="text-decoration: none;" class="nav-link" data-toggle="tooltip" data-placement="left" title="Back to the list of all users"><i class="fa fa-backward"></i></a>
			<?php else: ?>
				<a href="<?php echo URLROOT; ?>/pages/index/<?php echo $myposts_page; ?>/1" style="text-decoration: none;" class="nav-link" data-toggle="tooltip" data-placement="left" title="Back to the list of all users"><i class="fa fa-backward"></i></a>
			<?php endif; ?>
		</li>
		<li class="nav-item">
			<span class="nav-link" style="color:black;"><i class="fa fa-file"></i> My friends posts</span>
		</li>
		</ul>
		</div>
		</nav>
			<?php foreach($data['myfriends_posts'] as $myfriends_posts): ?>
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
					?>
				<div class="row justify-content-center">
					<div class="col-md-1" style="margin-right: -50px;margin-top: 17px;margin-right: 0px;">
						<div class="btn-groupp">
							<form action="<?php echo URLROOT . "/likes/likePost/" . $myfriends_posts->post_id; ?>" onsubmit="return likeSubmit();">
								<button class="like_button_<?php echo $myfriends_posts->post_id; ?> like_button_hover" style="padding-top:1px;padding-bottom:5px;"><i class="fa fa-thumbs-up like_icon_<?php echo $myfriends_posts->post_id; ?> like_icon_hover" style="margin-left: -12px;padding-bottom: 2px;"><span style="margin-left:2px;"><?php echo $myfriends_posts->post_likes_count; ?></span></i></button>
							</form>
							<form action="<?php echo URLROOT . "/dislikes/dislikePost/" . $myfriends_posts->post_id; ?>">
								<button class="dislike_button_<?php echo $myfriends_posts->post_id; ?> dislike_button_hover" style="padding-top:1px;padding-bottom:5px;"><i class="fa fa-thumbs-down dislike_icon_<?php echo $myfriends_posts->post_id; ?> dislike_icon_hover" style="margin-left: -12px;"><span style="margin-left:2px;"><?php echo $myfriends_posts->post_dislikes_count; ?></span></i></button>
							</form>
							<form action="<?php echo URLROOT . "/likes/likePost/" . $myfriends_posts->post_id; ?>">
								<button></button>
							</form>
						</div>
					</div>
					<div class="col-md-11">
						<?php
echo $data['count_myfriends_posts'];
					if($data['count_myfriends_posts'] == 0){
						echo "<p class='text-muted'>-- Posts will be display as soon as you have enough friends --</p>";
					}
						?>
				<span class="pull-right mt-3">
					by <a href="#"><?php echo $myfriends_posts->post_author ?></a>
				</span>
				<h3 class="mt-2 mb-3"><a href="<?php echo URLROOT . "/posts/show/" . $myfriends_posts->post_id ; ?>" class="post_title" style="text-decoration: none;"><?php echo $myfriends_posts->post_title ?></a>
				<?php
					if($myfriends_posts->post_rating == 1){
						echo "<i style='font-size:20px;color:yellow;text-shadow: 0 0 3px #000;' class='fa fa-star'></i>";
					}
					if($myfriends_posts->post_likes_count >= 1000){
						echo "<i style='font-size:20px;color:yellow;text-shadow: 0 0 3px #000;margin-left:5px;' class='fa fa-star'></i>";
					}
				?>
				</h3>
				<hr>
				<?php $category = new Categories(); 
				$post_cat = $category->findCategoryByPost($myfriends_posts->post_id);
				?>
				<p>Posted on <?php echo $myfriends_posts->post_date ?><span class="pull-right">Category : <?php echo $post_cat->cat_title ?></p>
				<hr>
				<?php
                if ($myfriends_posts->post_image):
                $post_user = $user->findUserById($myfriends_posts->post_user_id);
                $post_user_name = $post_user->user_name;
                ?>
                <a href="<?php echo URLROOT . "/posts/show/" . $myfriends_posts->post_id ?>"><img class='img-fluid rounded' style="width:100%" src="<?php echo URLROOT . "/images/posts_images/" . $post_user_name .  "_images/" . $myfriends_posts->post_image ?>" alt=''></a><hr>
				<?php endif; ?>
				<p class="mt-3"><?php echo $myfriends_posts->post_content; ?></p>
				</div>
			</div>
			<?php endforeach; ?>
			<?php if($count_myfriends_posts_for_pagination > 1 ): ?>
			<?php if($myfriends_posts_page <= 1): ?>
				<a class="btn btn-light text-secondary" href="#" aria-label="Previous">previous</a>
			<?php else: ?>
				<?php if($data['display'] === "search"): ?>
					<a class="btn btn-light" href="<?php echo  URLROOT . "/pages/index/" . $myposts_page . "/" . $back_myfriends_posts . "/search" ; ?>" aria-label="Previous">previous</a>
				<?php elseif($data['display'] === "mysearch"): ?>
					<a class="btn btn-light" href="<?php echo  URLROOT . "/pages/index/" . $myposts_page . "/" . $back_myfriends_posts . "/mysearch" ; ?>" aria-label="Previous">previous</a>
				<?php else: ?>
					<a class="btn btn-light" href="<?php echo  URLROOT . "/pages/index/" . $myposts_page . "/" . $back_myfriends_posts ; ?>" aria-label="Previous">previous</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if($myfriends_posts_page >= $count_myfriends_posts_for_pagination): ?>
				<a class="btn btn-light text-secondary pull-right" href="#" aria-label="Previous">next</a>
			<?php else: ?>
				<?php if($data['display'] === "search"): ?>
					<a class="btn btn-light pull-right" href="<?php echo  URLROOT . "/pages/index/" . $myposts_page . "/" . $for_myfriends_posts . "/search" ; ?>" aria-label="Previous">next</a>
				<?php elseif($data['display'] === "mysearch"): ?>
					<a class="btn btn-light pull-right" href="<?php echo  URLROOT . "/pages/index/" . $myposts_page . "/" . $for_myfriends_posts . "/mysearch" ; ?>" aria-label="Previous">next</a>
				<?php else: ?>
					<a class="btn btn-light pull-right" href="<?php echo  URLROOT . "/pages/index/" . $myposts_page . "/" . $for_myfriends_posts ; ?>" aria-label="Previous">next</a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
			<nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
			<?php if($data['display'] == 'mysearch'): ?>
			<a href="<?php echo URLROOT; ?>/pages/index/1/<?php echo $myfriends_posts_page; ?>/mysearch" style="text-decoration: none;" class="nav-link" data-toggle="tooltip" data-placement="left" title="Back to the list of all users"><i class="fa fa-backward"></i></a>
			<?php else: ?>
				<a href="<?php echo URLROOT; ?>/pages/index/1/<?php echo $myfriends_posts_page; ?>" style="text-decoration: none;" class="nav-link" data-toggle="tooltip" data-placement="left" title="Back to the list of all users"><i class="fa fa-backward"></i></a>
			<?php endif; ?>
		</li>
		<li class="nav-item">
			<span class="nav-link" style="color:black;"><i class="fa fa-file"></i> My posts</span>
		</li>
		</ul>
		<form action="<?php echo URLROOT ; ?>/searchs/searchMyPosts" method="post" class="form-inline my-2 my-lg-0">
				<div class="input-group input-group-sm">
				<input type="text" class="form-control" name="search_content_myposts" placeholder="Search for my posts">
				<div class="input-group-append">
				<button type="submit" name="search_myposts" class="input-group-text"><i class="fa fa-search"></i></button>
				</div>
			</form>
		</div>
		</nav>
			<?php foreach($data['myposts'] as $myposts): ?>
				<?php
					$likes = new Likes();
					$dislikes = new Dislikes();
					if($likes->liked($myposts->post_id)){
						?>
						<style type="text/css">
							.like_icon2_<?php echo $myposts->post_id; ?>{
								color:#7c7cff;
							}
							.btn-groupp form .like_button2_<?php echo $myposts->post_id; ?> {
								border-bottom: 2px solid #7c7cff;
							}
						</style>
						<?php
					}else{
						?>
						<style type="text/css">
							.like_icon2_<?php echo $myposts->post_id; ?> {
							  color: grey;
							}
							.btn-groupp form .like_button2_<?php echo $myposts->post_id; ?> {
							  border-bottom: 2px solid grey;
							}
						</style>
						<?php	
					}
					if($dislikes->disliked($myposts->post_id)){
						?>
						<style type="text/css">
							.dislike_icon2_<?php echo $myposts->post_id; ?>{
								color:#ff7a7a;
							}
							.btn-groupp form .dislike_button2_<?php echo $myposts->post_id; ?> {
								border-bottom: 2px solid #ff7a7a;
							}
						</style>
						<?php
					}else{
						?>
						<style type="text/css">
							.dislike_icon2_<?php echo $myposts->post_id; ?> {
							  color: grey;
							}
							.btn-groupp form .dislike_button2_<?php echo $myposts->post_id; ?> {
							  border-bottom: 2px solid grey;
							}
						</style>
						<?php	
					}
					?>
				<div class="row justify-content-cente">
					<div class="col-md-1" style="margin-right: -50px;margin-top: 17px;margin-right: 0px;">
						<div class="btn-groupp">
							<form action="<?php echo URLROOT . "/likes/likePost/" . $myposts->post_id; ?>" onsubmit="return likeSubmit();">
								<button class="like_button2_<?php echo $myposts->post_id; ?> like_button_hover" style="padding-top:1px;padding-bottom:5px;"><i class="fa fa-thumbs-up like_icon2_<?php echo $myposts->post_id; ?> like_icon_hover" style="margin-left: -12px;"><span style="margin-left:2px;"><?php echo $myposts->post_likes_count; ?></span></i></button>
							</form>
							<form action="<?php echo URLROOT . "/dislikes/dislikePost/" . $myposts->post_id; ?>">
								<button class="dislike_button2_<?php echo $myposts->post_id; ?> dislike_button_hover" style="padding-top:1px;padding-bottom:5px;"><i class="fa fa-thumbs-down dislike_icon2_<?php echo $myposts->post_id; ?> dislike_icon_hover" style="margin-left: -12px;"><span style="margin-left:2px;"><?php echo $myposts->post_dislikes_count ?></span></i></button>
							</form>
							<form action="<?php echo URLROOT . "/likes/likePost/" . $myposts->post_id; ?>">
								<button></button>
							</form>
						</div>
					</div>
					<div class="col-md-11">
						<span class="pull-right mt-3">
							by <a href="#"><?php echo $myposts->post_author ?></a>
						</span>
						<h3 class="mt-2 mb-3"><a href="<?php echo URLROOT . "/posts/show/" . $myposts->post_id ; ?>" style="text-decoration: none;"><?php echo $myposts->post_title ?></a></h3>
						<hr>
						<?php $category = new Categories(); 
						$post_cat = $category->findCategoryByPost($myposts->post_id);
						?>
						<p>Posted on <?php echo $myposts->post_date ?><span class="pull-right">Category : <?php echo $post_cat->cat_title ?></span></p>
						<hr>
						<?php
		                if ($myposts->post_image):
		                ?>
		                <a href="<?php echo URLROOT . "/posts/show/" . $myposts->post_id ?>"><img class='img-fluid rounded' style="width:100%" src="<?php echo URLROOT . "\images\posts_images\\" . $_SESSION['user_name'] . "_images\\" . $myposts->post_image; ?>" alt=''></a><hr>
						<?php endif; ?>
						<div class="mt-3"><?php echo $myposts->post_content; ?></div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php if($count_myposts_for_pagination > 1): ?>
			<?php if($myposts_page <= 1): ?>
				<a class="btn btn-light text-secondary" href="#" aria-label="Previous">previous</a>
			<?php else: ?>
				<?php if($data['display'] === "search"): ?>
					<a class="btn btn-light" href="<?php echo  URLROOT . "/pages/index/" . $back_myposts . "/" . $myfriends_posts_page . "/search" ; ?>" aria-label="Previous">previous</a>
				<?php elseif($data['display'] === "mysearch"): ?>
					<a class="btn btn-light" href="<?php echo  URLROOT . "/pages/index/" . $back_myposts . "/" . $myfriends_posts_page . "/mysearch" ; ?>" aria-label="Previous">previous</a>
				<?php else: ?>
					<a class="btn btn-light" href="<?php echo  URLROOT . "/pages/index/" . $back_myposts . "/" . $myfriends_posts_page ; ?>" aria-label="Previous">previous</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if($myposts_page >= $count_myposts_for_pagination): ?>
				<a class="btn btn-light text-secondary pull-right" href="#" aria-label="Previous">next</a>
			<?php else: ?>
				<?php if($data['display'] === "search"): ?>
					<a class="btn btn-light pull-right" href="<?php echo  URLROOT . "/pages/index/" . $for_myposts . "/" . $myfriends_posts_page . "/search" ; ?>" aria-label="Previous">next</a>
				<?php elseif($data['display'] === "mysearch"): ?>
					<a class="btn btn-light pull-right" href="<?php echo  URLROOT . "/pages/index/" . $for_myposts . "/" . $myfriends_posts_page . "/mysearch" ; ?>" aria-label="Previous">next</a>
				<?php else: ?>
					<a class="btn btn-light pull-right" href="<?php echo  URLROOT . "/pages/index/" . $for_myposts . "/" . $myfriends_posts_page ; ?>" aria-label="Previous">next</a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		</div>
		<div class="col-md-3 offset-md-9 scroll-sidebar" style="overflow: auto;height: 87vh;">
		<?php require APPROOT . '/views/inc/sidebar.php'; ?>
		<div class="modal fade" id="add-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		</div>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>