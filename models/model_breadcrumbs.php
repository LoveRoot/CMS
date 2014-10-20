<?php
    class model_breadcrumbs extends Model {
        public function __construct() {

            $this->breadcrumbs = "<a href='/'>Главная</a>&nbsp;&#187;&nbsp;";

            $result = Model::QueryString("Select id, name, page_type From pages");

            if ($result == true) {
                $this->pages = array();
                do {
                    if (!$result["id"])
                        continue;
                    $this->pages[$result["id"]][] = $result;
                } while ($result = mysqli_fetch_assoc(Model::$query));
                return $this->pages;
            } else {
                return false;
            }
        }

        public function GetBreadcrumbs($id=0) {

            if (isset($this->pages[$id])) {

                foreach ($this->pages[$id] as $breadcrumbs) {

                    $this->breadcrumbs .= "<a href='".Model::CombineUrl($breadcrumbs["page_type"], 'index', array("id" => $breadcrumbs["id"]))."'>{$breadcrumbs["name"]}</a>&nbsp;&#187;&nbsp;";

                    $this->GetBreadcrumbs($breadcrumbs["p_id"]);
                }
            }

            $this->breadcrumbs = substr($this->breadcrumbs,0,strlen($this->breadcrumbs) - 9);

            return $this->breadcrumbs;
        }
    }
?>

