<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Data Design Project</title>
	</head>

	<body>
		<header>
			<h1>Data Design Project</h1>
		</header>

		<main>
			<h2>Persona</h2>
			<ul>
				<li>17-24 years old.</li>
				<li>Having difficulty connecting in a disconnected world.</li>
				<li>Has trouble finding like minded individuals.</li>
				<li>Needs some way to both find like minded individuals, and connect with them.</li>
			</ul>

			<h2>Use Case and Interaction Flow</h2>
			<p>Assuming the user has already found a community they are interested in, and has decided
			on a post they wish to make.</p>
			<ol>
				<li>User clicks a button to create a new post.</li>
				<li>Site takes the user to a new post creation page.</li>
				<li>User titles their post, adds some content, and clicks the submission button.</li>
				<li>Site displays the users post at the top of the community, and returns the user to the
				community page.</li>
				<li>Another user sees the post, and wishes to comment.</li>
				<li>User 2 clicks on the post.</li>
				<li>Site takes user 2 to the page displaying the post.</li>
				<li>User clicks a button to comment on the post.</li>
				<li>Site takes user to a comment creation page.</li>
				<li>User writes content of comment and clicks the submit button.</li>
				<li>The site displays the comment on the post and returns user 2 to the post.</li>
				<li>User 1 wishes to reply to comment, and clicks the reply button.</li>
				<li>User 1 completes essentially the same process.</li>
				<li>The reply is now nested within the second user's comment, and this exchange can repeat if necessary.</li>
			</ol>

			<h2>Conceptual Model</h2>
			<h3>User</h3>
			<ul>
				<li>userId (primary key)</li>
				<li>userEmail</li>
				<li>userHash</li>
				<li>userName</li>
				<li>userSalt</li>
			</ul>

			<h3>Post</h3>
			<ul>
				<li>postId (primary key)</li>
				<li>postUserId (foreign key)</li>
				<li>postContent</li>
			</ul>

			<h3>Comment</h3>
			<ul>
				<li>commentId (primary key)</li>
				<li>commentPostId (foreign key)</li>
				<li>commentUserId (foreign key)</li>
				<li>commentCommentId (foreign key)</li>
				<li>commentContent</li>
			</ul>

		</main>
	</body>
</html>