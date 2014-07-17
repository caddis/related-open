_.defer(function() {
	_.delay(function() {
		var $relationshipOptions = $('.multiselect li');

		$relationshipOptions.click(function() {
			_.defer(function() {
				bindOpen();
			});
		});

		function bindOpen() {
			$('.multiselect-active li').add($relationshipOptions).each(function() {
				var $this = $(this),
					index = $this.data('list-index'),
					$elem = (index === undefined) ? $this : $relationshipOptions.eq(index),
					entryId = $elem.find('input:checkbox').val(),
					$openLink = $('<a href="' + EE.BASE + '&C=content_publish&M=entry_form&entry_id=' + entryId + '" target="_blank" class="related-open">open</a>');

				$openLink.click(function(e) {
					e.stopPropagation();
				});

				if ($this.closest('.multiselect').hasClass('empty') === false) {
					$this.append($openLink);
				}
			});
		}

		bindOpen();
	}, 500);
});