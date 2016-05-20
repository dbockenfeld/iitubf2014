<section class="intro-result">
	<section class="left70">
		<h3>Answer</h3>
		<p><?php echo $question->answer; ?></p>
	</section>
	<section class="right30 intro-related-questions">
		<h4>Related Questions</h4>
		<ul class="related-question-list">
			<?php foreach ($related_questions as $index => $q) : ?>
				<?php if ($index <= $limit) : ?>
				<li class="question-choice-related" data-index-number="<?php echo $q->question->id; ?>"><?php echo $q->question->question; ?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</section>
	<section class="intro-passages">
		<h4>Reference Passages</h4>
		<?php foreach ($passages as $region => $p) : ?>
			<section class="intro-region" data-region="<?php echo $region; ?>">
				<p>
				<sup><?php echo $region; ?></sup>
				<?php foreach ($p as $passage) : ?>
					<span class="ref-passage" data-passage="<?php echo $passage->ref; ?>"><?php echo $passage->refNoSpace; ?></span>
				<?php endforeach; ?>
				</p>
			</section>
		<?php endforeach; ?>
	</section>
</section>