function pick_file() {
	moxman.browse({
		oninsert: function(args) {
			document.getElementsByName("rkCSDWebsiteEngine.WebAdmin.ContentKeywords")[0].value = args.files[0].url;
		}
	});
}