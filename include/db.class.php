<?

/**
 * 使用mysqli实现的SAE数据库
 * Author: Rex
 */

// require_once ROOT_PATH . 'hacking.php';

class DB {
	// 数据库连接
	protected static $db = NULL;
	// 构造函数
	public static function connect($url, $username, $password, $database, $port = NULL) {
		self::$db = new mysqli($url, $username, $password, $database, $port);
		self::$db->set_charset("utf8mb4");
		self::$db->query("SET time_zone='+8:00'");
	}
	// 最底层的查询函数，数据错误或语法错误均返回false
	public static function query($sql) {
		$result = self::$db->query($sql);
		if ($result === true) {
			return true;
		} else if ($result === false) {
			if (DEBUG) die("<br>数据库查询错误<br>语句：" . $sql . "<br>MySQL输出：" . self::$db->error);
		} else if ($result->num_rows === 0) {
			return false;
		}
		return $result;
	}
	// 统计结果数量
	public static function count($sql) {
		$result = self::query($sql);
		return $result ? $result->num_rows : 0;
	}
	// 获取一条记录
	public static function getOne($sql, $key = NULL) {
		$sql .= " LIMIT 1";
		$result = self::query($sql);
		if ($result) {
			$t = $result->fetch_assoc();
			return ($key === NULL) ? $t : $t[$key];
		}
		else return false;
	}
	// 获取某一页的记录
	public static function getPage($sql, $pager = null) {
		if (!$pager) $pager = Request::$pager;
		if (!$pager) die('缺少分页器。');
		// 计算总数
		$count = self::count($sql);
		// 计算最大页数
		$pageMax = intval($count / $pager['pageSize']);
		if ($pageMax * $pager['pageSize'] < $count) {
			$pageMax++;
		}
		$start = ($pager['page'] - 1) * $pager['pageSize'];
		$data = [];
		if ($start <= $count) {
			$sql .= " LIMIT {$start}, {$pager['pageSize']}";
			$result = self::query($sql);
			if ($result === false) return $data;
			while ($row = $result->fetch_assoc())
				$data []= $row;
		}
		return [
			'data' => $data,
			'page' => $pager['page'],
			'pageSize' => $pager['pageSize'],
			'pageMax' => $pageMax
		];
	}
	// 获取全部记录
	public static function getAll($sql) {
		$return = [];
		$result = self::query($sql);
		if ($result === false) return $return;
		while ($row = $result->fetch_assoc())
			$return []= $row;
		return $return;
	}
	public static function prepare($sql) {
		return self::$db->prepare($sql);
	}
}
