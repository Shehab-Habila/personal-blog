function code() {
	code = document.getElementById('code').value;
	if (code == '') {
	}
	else {
		window.open("admin.php?code="+code, "_self");
	}
}

/**/

function post() {
	post = document.getElementById('postArea').value;
	if (post=='') {
	}
	else {
		window.open("post.php?post="+post, "_self");
	}
}
