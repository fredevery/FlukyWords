(function(){
	$fluky = {
			sentenceDiv:$("#sentence"),
			saveBtn:$("#save_btn"),
			allSentencesDiv:$("#all_sentences"),
			warning:$("#warning"),
			ini:
				function(){
					this.loadRandomSentence();
					this.saveBtn.click(function(){
						$fluky.saveSentence();
					})
					this.getAllSentences();
				},
			loadRandomSentence:
				function(){
					$.ajax({
						url:"controllers/controller.ajax.php?action=load_random_sentence",
						success:function(data){
							$fluky.spanifySentence(data);
						}
					})
				},
			spanifySentence:
				function(data){
					var dataArray = data.split(" ");
					var spannedSentence = "";
					$.each(dataArray,function(){
						spannedSentence += "<span>"+this+"</span> ";
					});
					this.sentenceDiv.html(spannedSentence);
					this.setSpanEvent()
				},
			setSpanEvent:
				function(){
					this.sentenceDiv.find("span").click(function(e){
						var target = e.target;
						var targetName = e.target.nodeName;
						if((targetName ==="SPAN" && $("span.edited").length < 2) || $(target).hasClass("edited")){
							$fluky.startEditing($(this));
						}else
						if($("span.edited").length === 2){
							$fluky.warning.slideDown("fast");
						}
					});
				},
			startEditing:
				function(obj){
					var clickedWord = obj.text();
					var wordLength = clickedWord.length;
					obj.addClass("editing")
					.html('<input type="text" value="'+clickedWord+'" size="'+wordLength+'" />')
					.find("input").focus().keypress(function(){
						$(this).parent().addClass("edited");
						$fluky.saveBtn.fadeIn("fast");
					})
					.blur(function(){
						$(this).parent()
						.text($(this).val())
						.removeClass("editing")								
						.end()
						.remove()
						if($("span.edited").length > 0){
							$fluky.saveBtn.fadeIn("fast");
						}
					});
				},
			saveSentence:
				function(){
					var newSentence = this.sentenceDiv.text()+"";
					$.post("controllers/controller.ajax.php?action=save_new_sentence",
							{sentence:newSentence},
							function(data){
								$fluky.saveBtn.fadeOut("fast",function(){
									$fluky.loadNewSentence();
									$fluky.loadRandomSentence();
								})
							})
				},
			getAllSentences:
				function(){
					$.ajax({
						url:"controllers/controller.ajax.php?action=get_all_sentences",
						success:function(data){
							var sentenceArray = data.split(",");
							var allSentencesHtml = "";
							$.each(sentenceArray,function(){
								allSentencesHtml += '<div class="old_sentence">'+this+'</div>';
							})
							$fluky.allSentencesDiv.html(allSentencesHtml);
						}
					})
				},
			loadNewSentence:
				function(){
					$.ajax({
						url:"controllers/controller.ajax.php?action=load_last_sentence",
						success:function(data){
							$fluky.allSentencesDiv.prepend('<div class="old_sentence latestSentence">'+data+'</div>')
							.find("div.latestSentence")
							.slideDown("fast");
						}
					});
				}
	}
	$fluky.ini();
})();