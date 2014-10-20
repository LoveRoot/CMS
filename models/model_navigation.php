<?php

    class model_navigation extends Model
    {

        public function __construct()
        {
            $this->page = $this->GetArray();
        }

        public function GetArray()
        {
            $result = Model::QueryString("Select id, p_id, name, status page_type From pages WHERE is_catalog = 1");
						;
            if ($result == true)
            {
                $this->tree_cat = array();
                do
                {
                    $this->tree_cat[$result["p_id"]][] = $result;
                } while ($result = mysqli_fetch_assoc(Model::$query));
                return $this->tree_cat;
            } else
            {
                return false;
            }

        }

				public function TopNavigation($p_id=0) {

					if (isset($this->page[$p_id])) {

						$this->top_nav .="<ul>";

						foreach($this->page[$p_id] as $nav) {

							$active = isset($this->data['page']["id"]) && $this->data['page']["id"] == $nav["id"] || isset($this->data['page']["p_id"]) && $this->data['page']["p_id"] == $nav["id"] ? "active" : "";

							$this->top_nav .= "<li>";

							$this->top_nav .= "<a href='".Model::CombineUrl($nav["page_type"], "index", array("id" => $nav["id"]))."' {$active}>".$nav["name"]."</a>";

							$this->TopNavigation($nav["id"]);

							$this->top_nav .= "</li>";
						}

						$this->top_nav .="</ul>";


					}


					return $this->top_nav;

				}

        public function GetResult()
        {
            return $this->page;
        }

    }
