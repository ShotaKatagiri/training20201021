<?php
class BasicClass
{
	//返したい値は全て$returnとする
	// static function for_example($str=null)
	// {
	// 	$hoge['fuga'] = 2 + 3;
	// 	if(empty($str)){
	// 		$str = [];
	// 	}
	// 	$return = (array)$str + (array)$hoge;
	// 	return $return;
	// }

	public static $message = '';

	static function admin_top($str = null)
	{
		return $str;
	}

	static function product_list($str = null)
	{
		try {
			$model = new Model();
			$pdo = $model->pdo;

			if (!empty($_POST['delete'])) {
				$sql =
					' UPDATE '
						. ' dojin_product '
					. ' SET '
						. ' dojin_product_status = false '
					. ' WHERE '
						. ' dojin_product_no = ? '
				;
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array($_POST['dojin_product_no']));
			}

			$sort = array (
				1 => 'dojin_product_no',
				2 => 'dojin_product_name',
				3 => 'dojin_product_price',
				4 => 'dojin_product_upd_ts'
			);

			//product_listページでのソート機能（商品No、商品名、商品価格、更新日時）
			if (!empty($_GET['sort']) && !empty($_GET['order'])) {
				$sort_result = $model->dbSort($sort[$_GET['sort']], $_GET['order']);
			} else {
				$sort_result = 'ORDER BY dojin_product_ins_ts DESC';
			}
			$sql =
				' SELECT '
					. ' * '
				. ' FROM '
					. ' dojin_product '
				. ' WHERE '
					. ' dojin_product_status = true '
				. $sort_result
			;
			$stmt = $pdo->query($sql);
			$str['result'] = $stmt->fetchAll();

			//index(ユーザー)ページでの商品リストのソート機能判定
			if (!empty($_POST['sort_priority'])) {
				$sql =
					' UPDATE '
						. ' dojin_data_set '
					. ' SET '
					. ' use_sort_priority_status = '
					. $_POST['use_sort_priority_status']
				;
				$stmt = $pdo->query($sql);
			}
			$sql =
				' SELECT '
					. ' use_sort_priority_status '
				. ' FROM '
					. ' dojin_data_set '
			;
			$stmt = $pdo->query($sql);
			$str['check'] = $stmt->fetchColumn();
		} catch (PDOException $e) {
			self::$message = 'システムエラーのため、do-jinwork@abc.jpにお問い合わせ下さい。';
		}
		$str['message'] = self::$message;
		return $str;
	}

	static function product_edit($str = null)
	{
		if ($_GET['mode'] == 'update') {
			if (!empty($_POST['upload'])) {
				if ($_FILES['upfile']['error'] != UPLOAD_ERR_NO_FILE) {
					try {
						$model = new Model();
						$pdo = $model->pdo;

						$img_name = date('YmdHis') . $_FILES['upfile']['name'];

						$pdo->beginTransaction();

						$sql =
							' UPDATE dojin_product SET '
								. ' dojin_product_img = ?, '
								. ' dojin_product_upd_ts = now(6) '
							. ' WHERE '
								. ' dojin_product_no = ? '
						;
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array($img_name, $_GET['dojin_product_no']));

						//画像がtmpフォルダーに移動成功した時
						if ($_FILES['upfile']['error'] == UPLOAD_ERR_OK) {
							$command = 'sudo chmod 777 /var/www/html/' . WBT_IMG;
							exec($command);

							//画像をtmpファルダ―からWBT_IMGフォルダーに移動が失敗した場合
							if (!move_uploaded_file($_FILES['upfile']['tmp_name'], '/var/www/html/' . WBT_IMG . mb_convert_encoding($img_name, 'cp932', 'utf8'))) {
								$command = 'sudo chmod 755 /var/www/html/' . WBT_IMG;
								exec($command);
								//exec('sudo chmod 755 /var/www/html/' . WBT_IMG);
								throw new Exception('アップロードに失敗しました。システムエラーのため、do-jinwork@abc.jpにお問い合わせ下さい。');
							}

							$pdo->commit();
							//exec('sudo chmod 0755 /var/www/html/' . WBT_IMG);
							$command = 'sudo chmod 0755 /var/www/html/' . WBT_IMG;
							exec($command);
						} else {

							//画像がtmpフォルダーに移動失敗した場合
							throw new Exception('アップロードに失敗しました。システムエラーのため、do-jinwork@abc.jpにお問い合わせ下さい。');
						}
					} catch (PDOException $e) {
						self::$message = 'システムエラーのため、更新出来ませんでした。do-jinwork@abc.jpにお問い合わせ下さい。';
						$pdo->rollback();
					} catch (Exception $e) {
						self::$message = $e->getMessage();
						$pdo->rollback();
					}
				} else {
					self::$message = '画像を選択してください。';
				}
			}
			try {
				$model = new Model();
				$pdo = $model->pdo;

				$sql =
					' SELECT '
						. ' * , '
						. ' CASE WHEN '
							. ' dojin_product_upd_ts is NULL '
						. ' THEN '
							. ' dojin_product_ins_ts '
						. ' ELSE '
							. ' dojin_product_upd_ts '
						. ' END '
						. ' AS '
							. ' date '
					. ' FROM '
						. ' dojin_product '
					. 'WHERE '
						. 'dojin_product_no = ? '
				;
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array($_GET['dojin_product_no']));
				$result = $stmt->fetch();
			} catch (PDOException $e) {
				self::$message = 'システムエラーのため、最終更新日を表示出来ませんでした。<br>do-jinwork@abc.jpにお問い合わせ下さい。';
			}
		} else {
			$result = array();
		}
		$str['message'] = self::$message;

		$str['product_list'] = $_POST + $result;

		return $str;
	}

	static function product_conf($str = null)
	{
		return $str;
	}

	static function product_done($str = null)
	{
		try {
			$model = new Model();
			$pdo = $model->pdo;

			if ($_GET['mode'] == 'register') {

				//メッセージのための変数
				$text = '登録';

				$sql =
					' INSERT INTO dojin_product ( '
						. ' dojin_product_name, '
						. ' dojin_product_price, '
						. ' dojin_product_genre_type, '
						. ' dojin_product_comment, '
						. ' dojin_product_sort_priority '
					. ' ) VALUES ('
						. ' ?, '
						. ' ?, '
						. ' ?, '
						. ' ?, '
						. ' ? '
					. ' ) '
				;
				$stmt = $pdo->prepare($sql);
				$stmt->execute(
					array(
						$_POST['dojin_product_name'],
						$_POST['dojin_product_price'],
						$_POST['dojin_product_genre_type'],
						$_POST['dojin_product_comment'],
						$_POST['dojin_product_sort_priority']
					)
				);
			} elseif ($_GET['mode'] == 'update') {

				//メッセージのための変数
				$text = '編集';

				$sql =
					' UPDATE dojin_product SET '
						. ' dojin_product_name = ?, '
						. ' dojin_product_price = ?, '
						. ' dojin_product_genre_type = ?, '
						. ' dojin_product_comment = ?, '
						. ' dojin_product_sort_priority = ?, '
						. ' dojin_product_upd_ts = now(6) '
					. ' WHERE '
						. ' dojin_product_no = ? '
				;
				$stmt = $pdo->prepare($sql);
				$stmt->execute(
					array(
						$_POST['dojin_product_name'],
						$_POST['dojin_product_price'],
						$_POST['dojin_product_genre_type'],
						$_POST['dojin_product_comment'],
						$_POST['dojin_product_sort_priority'],
						$_GET['dojin_product_no']
					)
				);
			}
			self::$message = $text . 'が完了しました。';
		} catch (PDOException $e) {
			self::$message = $text . 'が失敗しました。<br>システムエラーのため、do-jinwork@abc.jpにお問い合わせ下さい。';
		}
		$str['message'] = self::$message;
		return $str;
	}

	static function sale_statistics($str = null)
	{
		$model = new Model();
		$pdo = $model->pdo;

		//$csv = new Csv();

		$search = '';
		//$datas[] = '';

		if (!empty($_POST['search'])) {
			$search = ' WHERE 1 ';

			if (!empty($_POST['search_puroduct_name'])) {
				$search .= ' AND purchase_product_name LIKE ? ';
				$datas[] = '%' . $_POST['search_puroduct_name'] . '%';
			}

			if (!empty($_POST['search_month_from']) && !empty($_POST['search_month_to'])) {
				$datas[] = date('Y-m-01', strtotime($_POST['search_month_from']));

				if (date('n', strtotime($_POST['search_month_to'])) - date('n', strtotime($_POST['search_month_from'])) < 3) {
					$datas[] = date('Y-m-t', strtotime($_POST['search_month_to']));
				} else {
					$datas[] = date('Y-m-t', strtotime($_POST['search_month_from'] . '+2 month'));
				}

				$search .= ' AND DATE_FORMAT(calendar_date, \'%Y/%m\') BETWEEN DATE_FORMAT(?, \'%Y/%m\') AND DATE_FORMAT(?, \'%Y/%m\') ';
			}

			if (!empty($_POST['search_month_from']) && empty($_POST['search_month_to'])) {
				$search .= ' AND DATE_FORMAT(calendar_date, \'%Y/%m\') BETWEEN DATE_FORMAT(?, \'%Y/%m\') AND DATE_FORMAT(?, \'%Y/%m\') ';

				$datas[] = date('Y-m-01', strtotime($_POST['search_month_from']));
				$datas[] = date('Y-m-t', strtotime($_POST['search_month_from'] . '+2 month'));
			}

			if (empty($_POST['search_month_from']) && !empty($_POST['search_month_to'])) {
				$search .= ' AND DATE_FORMAT(calendar_date, \'%Y/%m\') BETWEEN DATE_FORMAT(?, \'%Y/%m\') AND DATE_FORMAT(?, \'%Y/%m\') ';

				$datas[] = date('Y-m-01', strtotime(date('Y-m-t', strtotime($_POST['search_month_to'])) . '-2 month'));
				$datas[] = date('Y-m-t', strtotime($_POST['search_month_to']));
			}
		} elseif(!empty($_POST['reset'])){
			$search = ' WHERE 1 ';
		} //else {
		// 	$search = ' WHERE 1 ';
		// }

		$sql =
			' SELECT '
				. ' calendar_date , '
				. ' COALESCE(purchase_product_name, NULL) AS purchase_product_name, '
				. ' COALESCE(total_purchase_product_num, 0) AS total_purchase_product_num, '
				. ' COALESCE(total_purchase_shipping, 0) AS total_purchase_shipping, '
				. ' COALESCE(total_purchase_price, 0) AS total_purchase_price '
			. ' FROM '
				. ' calendar AS c '
				. ' LEFT JOIN ( '
					. ' SELECT '
						. ' purchase_date, '
						. ' purchase_product_name, '
						. ' SUM(total_purchase_product_num) AS total_purchase_product_num, '
						. ' SUM(shipping) AS total_purchase_shipping, '
						. ' SUM(total_purchase_price) AS total_purchase_price '
					. ' FROM ( '
						. ' SELECT '
							. ' do.dojin_order_no, '
							. ' DATE_FORMAT(do.dojin_order_ins_ts, \'%Y/%m/%d\') AS purchase_date, '
							. ' GROUP_CONCAT(dod.dojin_order_detail_product_name) AS purchase_product_name, '
							. ' SUM(dod.dojin_order_detail_product_num) AS total_purchase_product_num, '
							. ' do.dojin_order_shipping_price AS shipping, '
							. ' dojin_order_total_price AS total_purchase_price '
						. ' FROM '
							. ' dojin_order_detail AS dod JOIN dojin_order AS do '
								. ' USING(dojin_order_no) '
						. ' GROUP BY '
							. ' dojin_order_no '
					. ' ) AS sub '
					. ' GROUP BY '
						. ' purchase_date '
				. ' ) AS sub2 '
					. ' ON c.calendar_date = sub2.purchase_date '
			. $search
			. ' HAVING '
				. ' calendar_date <= NOW() '
			. ' ORDER BY '
				. ' calendar_date DESC '
			. ' limit 30 '
		;

		//if (!empty($search)) {
		if (!empty($datas)) {
			$stmt = $pdo->prepare($sql);
			$stmt->execute($datas);
		} else {
			$stmt = $pdo->query($sql);

		}


		//$str['month_from'] = $month_from;
		//$str['sql'] = $sql;
		//$str['search'] = $search;
		//$str['dates'] = $datas;

		$str['result'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (!empty($_POST['csv'])) {
			$csv = new Csv();
			//$csv->csvOutput($str['result']);
			$str['all_sale_list']= $csv->csvOutput($str['result']);
		}

		return $str;
	}

	static function error_404($str=null)
	{
		echo '404　'.$str.'というページは存在しないのですよ・・・三└(┐Lε:)┘';
	}

	static function error_template($str=null)
	{
		echo '404　'.$str.'というテンプレートファイルは存在しないのですよ・・・_(:3 」∠ )_ ';
	}
}