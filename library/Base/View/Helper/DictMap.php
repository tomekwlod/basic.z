<?php

class Base_View_Helper_DictMap extends Zend_View_Helper_Abstract {
	/**
	 * Mapowanie słownikowe wartości
	 * Przystosowane do mapowania na wierszu i paginatorze
	 *
	 * @param Zend_Db_Table_Row $row
	 * @param string $key
	 * @param Zend_Paginator $paginator
	 * @return string
	 */
	public function DictMap($row, $key, $paginator = null) {
		if($row instanceof Zend_Db_Table_Row)
			$ret = $row->getDictMapping($key, $row);
		else
			$ret = $paginator->getDictMapping($key);

		if(isset($ret[$row[$key]])) return $ret[$row[$key]];
	    
		return $row[$key];
	}

}