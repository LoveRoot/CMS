<?php
	class model_article extends Model {
		public function __construct() {

		}

		public function GetShortNews($p_id) {
			$result = new Pagination("Select a.id, a.title as a_title, a.link, a.author, a.date,
                                                         a.shortnews, a.fullnews, a.status, a.views, a.vote, a.main,
                                                         a.prioritet, a.session_views, a.session_vote, p.title, p.link, p.type, p.num_row, p.tree
                                                         From article as a, pages as  p where a.status = 1 and a.p_id = '".intval($p_id)."' and p.id = a.p_id",
                                                         "Select id From article as a where a.status = 1 and a.p_id = '".intval($p_id)."'", 10);
			return $result;

		}
	}
?>