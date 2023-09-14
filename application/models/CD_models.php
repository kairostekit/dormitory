<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CD_models extends CI_Model
{
    private $mssql = null;
    private $DB = "";
    private $SCHEMA = "";
    private $KEYID = null;
    private $TABLE = null;
    private $field_name = array();
    private $data = array();
    private $last_id = null;
    private $sPRIMARY_KEY =  '';


    private $join = array();
    private $where = array();
    private $select = array();
    private $order_by = array();
    private $group_by = array();
    private $results = "object";
    private $rowOne = false;
    public $query_results = array();
    public $SQL = '';


    // public $DataResults = array();

    public function __construct()
    {

        parent::__construct();
        $this->mssql = $this->load->database('MYSQL', TRUE);

        // return $this->Query;
    }

    /**
     * Get
     *  @return  true || false
     *  $sql = 'SELECT * FROM some_table WHERE id = :id: AND status = :status: AND author = :name:';
     *  $paramiter =  [
     *       'id'     => 3,
     *       'status' => 'live',
     *       'name'   => 'Rick',
     *   ]
     */
    public function Query_TextInsetUpdate($sql_text, $paramiter = array())
    {
        // Query_TextInsetUpdate
        try {
            $query = $this->mssql->query($sql_text, $paramiter);
            $this->setSQL($this->mssql->last_query());

            $this->setLast_id($this->mssql->insert_id());
            $this->setQuery_results(true);

            $this->clone_cle();
            return $this->getQuery_results();
        } catch (Exception $e) {
            $this->setQuery_results(false);
            return $this->getQuery_results();
        }

    }

    public function Query_TextData($sql_text, $paramiter = array())
    {
        try {
            $query = $this->mssql->query($sql_text, $paramiter);
            $this->setSQL($this->mssql->last_query());

            $this->setQuery_results($query->result());
            $this->clone_cle();
            return $this->getQuery_results();
        } catch (Exception $e) {
            $this->setQuery_results(false);
            return $this->getQuery_results();
        }

    }

    public function clone_cle ()
    {
        $this->setGroup_by('');
        $this->setData('');
        $this->setJoin('');
        $this->setOrder_by('');
        $this->setWhere('');
        $this->setResults('');
        $this->setRowOne('');
        $this->setSelect('');
    }




    /**
     * Get the value of Query
     */
    public function Query()
    {

        $temp = array();
        $JOIN = array();
        $GROUP_BY = array();
        $SELECT = array();
        $WHERE = array();
        $ORDER_BY = array();
        $TYPE_RESULT = $this->getResults();
        $ONE_ROW = $this->getRowOne();
        $TABLE_NAME = $this->TB_NAME();

        $JOIN = !empty($this->getJoin()) ? $this->getJoin() : array();
        $GROUP_BY = !empty($this->getGroup_by()) ? $this->getGroup_by() : array();
        $SELECT = !empty($this->getSelect()) ? $this->getSelect() : array();
        $WHERE = !empty($this->getWhere()) ? $this->getWhere() : array();
        $ORDER_BY = !empty($this->getOrder_by) ? $this->getOrder_by : array();
        $TYPE_RESULT = !empty($this->getResults()) ? $this->getResults() : 'object';

        $ONE_ROW = !empty($this->getRowOne()) ? $this->getRowOne() : false;
        $TABLE_NAME = !empty($this->TB_NAME()) ? $this->TB_NAME() : $this->TB_NAME();


        $this->mssql->from($TABLE_NAME);

        if (!empty($WHERE)) {
            foreach ($WHERE as $key_WHERE => $item_WHERE):

                if ($key_WHERE == "CUSTOMS") {
                    if (gettype($item_WHERE) == "array") {
                        foreach ($item_WHERE as $item) {
                            $this->mssql->where($item);
                        }

                    }

                    if (gettype($item_WHERE) == "string") {
                        $this->mssql->where($item_WHERE);
                    }

                    continue;
                }

                if (gettype($item_WHERE) == 'array') {

                    foreach ($item_WHERE as $key_item_WHERE => $item_item_WHERE):
                        if ($key_item_WHERE !== 0) {

                            $TB_ = $key_WHERE;
                            $KE_ = $key_item_WHERE;

                            if ($key_item_WHERE == 'GROUPS_1' || $key_item_WHERE == 'GROUPS_2' || $key_item_WHERE == 'GROUPS_3' || $key_item_WHERE == 'GROUPS_4' || $key_item_WHERE == 'GROUPS_5' || $key_item_WHERE == 'GROUPS_6' || $key_item_WHERE == 'GROUPS_7' || $key_item_WHERE == 'GROUPS_8' || $key_item_WHERE == 'GROUPS_9' || $key_item_WHERE == 'GROUPS_10') {

                                if ($item_item_WHERE !== null) {

                                    if (isset($item_item_WHERE['GROUP_AND'])) {
                                        if ($item_item_WHERE['GROUP_AND'] == 'AND') {
                                            $this->mssql->group_start();
                                        } else {
                                            $this->mssql->or_group_start();
                                        }
                                    } else {
                                        $this->mssql->group_start();
                                    }



                                    foreach ($item_item_WHERE as $dki => $dii):


                                        if ($dki === 'GROUP_AND') {
                                            continue;
                                        }



                                        if ($dki === 'GROUP_1' || $dki === 'GROUP_2' || $dki === 'GROUP_3' || $dki === 'GROUP_4' || $dki === 'GROUP_5') {

                                            if (isset($dii['GROUP_AND'])) {
                                                if ($dii['GROUP_AND'] == 'AND') {
                                                    $this->mssql->group_start();
                                                } else if ($dii['GROUP_AND'] == 'OR') {
                                                    $this->mssql->or_group_start();
                                                }
                                            } else {
                                                $this->mssql->group_start();
                                            }


                                            foreach ($dii as $kgroupi => $kgroupii):

                                                $DGS_COL = $kgroupi;
                                                $DGS_DATA = isset($kgroupii['DATA']) ? $kgroupii['DATA'] : array();
                                                $DGS_CONDITION = strtoupper(isset($kgroupii['CONDITION']) ? $kgroupii['CONDITION'] : 'and');
                                                $DGSGROUP = isset($kgroupii['GROUP_AND']) ? $kgroupii['GROUP_AND'] : NULL;


                                                if ($kgroupi === 'GROUP_AND') {
                                                    continue;
                                                }


                                                if (empty($DGS_DATA)) {
                                                    continue;
                                                }

                                                // return  $kgroupii;
                                                $DGS_DATA = $DGS_DATA === 'NULL' ? NULL : $DGS_DATA;



                                                if ($DGSGROUP == 'AND') {
                                                    $this->mssql->group_start();
                                                } else if ($DGSGROUP == 'OR') {
                                                    $this->mssql->or_group_start();
                                                }


                                                switch ($DGS_CONDITION) {

                                                    case 'AND':
                                                        if (gettype($DGS_DATA) == "array") {

                                                            foreach ($DGS_DATA as $DGSKI => $DGSII):
                                                                $this->mssql->where(sprintf("%s.%s", $TB_, $DGS_COL), $DGSII, FALSE);
                                                            endforeach;

                                                        } else {

                                                            $this->mssql->where(sprintf("%s.%s", $TB_, $DGS_COL), $DGS_DATA);

                                                        }
                                                        break;
                                                }


                                                if (isset($DGSGROUP)) {
                                                    $this->mssql->group_end();
                                                }

                                            endforeach;


                                            $this->mssql->group_end();
                                            continue;
                                        }


                                        $D_COL = $dki;
                                        $D_DATA = isset($dii['DATA']) ? $dii['DATA'] : array();
                                        $D_CONDITION = strtoupper(isset($dii['CONDITION']) ? $dii['CONDITION'] : 'and');
                                        $GROUP = isset($dii['GROUP']) ? $dii['GROUP'] : false;


                                        if (empty($D_DATA)) {
                                            continue;
                                        }

                                        $D_DATA = $D_DATA === 'NULL' ? NULL : $D_DATA;

                                        // return $D_DATA;
                                        switch ($D_CONDITION) {
                                            case 'OR_LIKE':
                                                if (gettype($D_DATA) == "array") {
                                                    if ($GROUP == true) {
                                                        $this->mssql->group_start();
                                                    }


                                                    foreach ($D_DATA as $key_DK => $item_DK):
                                                        $this->mssql->or_like(sprintf("%s.%s", $TB_, $D_COL), $item_DK, 'both');
                                                    endforeach;

                                                    if ($GROUP == true) {
                                                        $this->mssql->group_end();
                                                    }

                                                } else {
                                                    $this->mssql->or_like(sprintf("%s.%s", $TB_, $D_COL), $D_DATA, 'both');
                                                }
                                                break;
                                            case 'AND':
                                                // $this->mssql->where(sprintf('%s.%s = %s', $TB_, $D_COL), $D_DATA, FALSE);
                                                if (gettype($D_DATA) == "array") {
                                                    if ($GROUP == true) {
                                                        $this->mssql->group_start();
                                                    }
                                                    foreach ($D_DATA as $key_DK => $item_DK):
                                                        $this->mssql->where(sprintf("%s.%s", $TB_, $D_COL), $item_DK, FALSE);
                                                    endforeach;
                                                    if ($GROUP == true) {
                                                        $this->mssql->group_end();
                                                    }
                                                } else {
                                                    // $this->mssql->where();
                                                    $this->mssql->where(sprintf("%s.%s", $TB_, $D_COL), $D_DATA);

                                                }
                                                break;
                                        }

                                    endforeach;

                                    $this->mssql->group_end();

                                }

                                continue;
                            }

                            if (gettype($item_item_WHERE) == "array") {

                                $item_item_WHERE = (object) $item_item_WHERE;
                                $item_item_WHERE_array = $item_item_WHERE;

                                $CONDITION = strtoupper(isset($item_item_WHERE->CONDITION) ? $item_item_WHERE->CONDITION : 'and');
                                $DATA_K = isset($item_item_WHERE->DATA) ? $item_item_WHERE->DATA : array();
                                $GROUP = isset($item_item_WHERE->GROUP) ? $item_item_WHERE->GROUP : false;

                                if (empty($DATA_K)) {
                                    continue;
                                }

                                switch ($CONDITION) {
                                    case 'OR':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->or_where(sprintf("%s.%s", $TB_, $KE_), $item_DK);
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->or_where(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }
                                        break;
                                    case 'IN':
                                        if (gettype($DATA_K) == "array") {

                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }

                                        } else {
                                            $this->mssql->where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                        }

                                        break;
                                    case 'OR_IN':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->or_where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->or_where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }
                                        break;
                                    case 'NOT_IN':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }

                                        break;
                                    case 'OR_NOT_IN':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }

                                        } else {
                                            $this->mssql->or_where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                        }
                                        break;
                                    case 'AND':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $item_DK);
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }
                                        break;
                                    case 'LIKE':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->like(sprintf("%s.%s", $TB_, $KE_), $item_DK, 'both');
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->like(sprintf("%s.%s", $TB_, $KE_), $DATA_K, 'both');
                                        }
                                        break;
                                    case 'OR_LIKE':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->or_like(sprintf("%s.%s", $TB_, $KE_), $item_DK, 'both');
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->or_like(sprintf("%s.%s", $TB_, $KE_), $DATA_K, 'both');
                                        }
                                        break;
                                }
                            } else {
                                $this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $item_item_WHERE);
                            }
                        }
                    endforeach;
                }
            endforeach;
        }

        if (!empty($SELECT)) {
            $count_select = 0;
            $temp_SELECT = '';
            foreach ($SELECT as $key_seletct => $item_seletct):

                if ($key_seletct == "CUSTOMS") {
                    if (gettype($item_seletct) == "array") {
                        foreach ($item_seletct as $item) {
                            $this->mssql->select($item,FALSE );
                        }

                    }

                    if (gettype($item_seletct) == "string") {
                        $this->mssql->select($item_seletct,FALSE );
                    }

                    continue;
                }



                $temp_SELECT .= $count_select == 0 ? ' ' : ",";
                foreach ($item_seletct as $key_item_seletct => $item_item_seletct):
                    $temp_SELECT .= $key_item_seletct == 0 ? ' ' : ",";
                    $temp_SELECT .= " " . $key_seletct . '.' . $item_item_seletct . ' ';
                endforeach;
                $count_select++;
            endforeach;
            $this->mssql->select($temp_SELECT);
        }

        if (!empty($GROUP_BY)) {
            $temp_GROUP = '';
            $count_group = 0;
            foreach ($GROUP_BY as $key_group => $item_group):
                $temp_GROUP .= $count_group == 0 ? ' ' : ",";
                foreach ($item_group as $key_item_group => $item_item_group):
                    $temp_GROUP .= $key_item_group == 0 ? '' : ",";
                    $temp_GROUP .= "$key_group" . '.' . $item_item_group . ' ';
                endforeach;
                $count_group++;
            endforeach;
            if (empty($SELECT)) {
                $this->mssql->select($temp_GROUP);
            }
            $this->mssql->group_by($temp_GROUP);
        }


        if (empty($SELECT) && empty($GROUP_BY)) {
            $this->mssql->select("*");
        }


        if (!empty($JOIN)) {
            foreach ($JOIN as $key => $item):
                $TBL_JOIN = $key;
                $ON = isset($item['ON']) ? $item['ON'] : self::$sPRIMARY_KEY;
                $JOIN = isset($item['JOIN']) ? $item['JOIN'] : $TABLE_NAME;
                $KEY_JOIN = isset($item['KEY_JOIN']) ? $item['KEY_JOIN'] : $ON;
                $TYPE = isset($item['TYPE']) ? $item['TYPE'] : 'INNER';

                $this->mssql->join($TBL_JOIN, "{$JOIN}.{$KEY_JOIN} = {$TBL_JOIN}.{$ON}  ", "{$TYPE}");
            endforeach;
        }

        if (!empty($ORDER_BY)) {
            foreach ($ORDER_BY as $key_ORDER_BY => $item_ORDER_BY):
                $TBL_ = $key_ORDER_BY;
                foreach ($item_ORDER_BY as $key_item_ORDER_BY => $item_item_ORDER_BY):
                    $this->mssql->order_by("{$TBL_}.{$key_item_ORDER_BY}", $item_item_ORDER_BY);
                endforeach;
            endforeach;
        }


        try {
            $query = $this->mssql->get();
            if ($TYPE_RESULT == 'object' && $ONE_ROW != true) {
                $temp = $query->result_object();
            } elseif ($TYPE_RESULT == 'array' && $ONE_ROW != true) {
                $temp = $query->result_array();
            } elseif ($TYPE_RESULT == 'object' && $ONE_ROW == true) {
                $temp = $query->row_object();
            } elseif ($TYPE_RESULT == 'array' && $ONE_ROW == true) {
                $temp = $query->row_array();
            } else {
                $temp = $query->result_object();
            }

            $this->clone_cle();
            $this->setQuery_results($temp);
            $this->setSQL($this->mssql->last_query());
            return $this->getQuery_results();
        } catch (Exception $e) {
            // return $e;
            $this->clone_cle();

            return $this->getQuery_results();
        }




    }


    public function TB_NAME()
    {
        return sprintf("%s",  $this->TABLE);
    }

    public function LastID($KEYID = null)
    {

        if ($KEYID == null) {
            // $this->mssql->select(sprintf("MAX(%s.%s) AS MAX_ID", $this->TABLE, self::$KEYID));
            $this->mssql->select_max(sprintf("%s.%s", $this->TABLE, self::$KEYID), "MAX_ID");
        } else {
            $this->mssql->select(sprintf("MAX(%s.%s) AS MAX_ID", $this->TABLE, $KEYID));
        }


        $this->mssql->limit(1);
        $this->mssql->from(sprintf("%s as %s", self::TB_NAME(), $this->TABLE));

        $query = $this->mssql->get();

        $temp = $query->row_object();
        if ($temp !== null) {
            if ($temp->MAX_ID == null)
                return 0;
            else
                return $temp->MAX_ID;

        } else {
            return 0;
        }
    }

    public function InsertResources($data = [])
    {

        $ex = [
            "field_name" => "value"
        ];


        $temp_data = array();
        if (empty($data)) {
            $temp_data = $this->data;
        } else {
            $temp_data = $data;
        }

        if ($data !== NULL) {
            $this->mssql->insert($this->TB_NAME(), $temp_data);
            return $this->mssql->insert_id();
        } else {
            return false;
        }

    }

    public function UpdateResources($data = array())
    {
        $ex = [
            "WHERE" => [
                "field_name" => "VALUE"
            ],
            "DATA" => [
                "field_name" => "VALUE",
            ],
            "TABLE" => "TB_NAME"
        ];


        $temp_data = array();
        if (empty($data)) {
            $temp_data = $this->data;
        } else {
            $temp_data = $data;
        }

        $temp_data = (object) $temp_data;

        $WHERE = isset($temp_data->WHERE) ? $temp_data->WHERE : array();
        $DATA = isset($temp_data->DATA) ? $temp_data->DATA : array();
        $TABLE = isset($temp_data->TABLE) ? $temp_data->TABLE : $this->TB_NAME();

        if (!empty($WHERE)) {
            foreach ($WHERE as $key_WHERE => $item_WHERE):
                $this->mssql->where(sprintf("%s", $key_WHERE), $item_WHERE);
            endforeach;
        }

        if (!empty($DATA)) {

            foreach ($DATA as $key_DATA => $item_DATA):
                $this->mssql->set(sprintf("%s", $key_DATA), $item_DATA);
            endforeach;

        }

        if (!empty($TABLE && !empty($DATA))) {
            try {
                $this->mssql->update($TABLE);
                return true;
            } catch (Exception $e) {
                return false;
            }

        }

        return false;

    }


    public function DeleteResources($data)
    {

        $ex = [
            "TABLE" => 'TABLE_NAME',
            "WHERE" => [
                "field_name" => "value",
            ]
        ];


        $temp_data = array();
        if (empty($data)) {
            $temp_data = $this->data;
        } else {
            $temp_data = $data;
        }



        try {
            $WHERE = isset($temp_data->WHERE) ? $temp_data->WHERE : array();
            $TABLE = isset($temp_data->TABLE) ? $temp_data->TABLE : $this->TB_NAME();
            if (!empty($WHERE)) {
                foreach ($WHERE as $ki => $ii):
                    $this->mssql->where($ki, $ii);
                endforeach;
            }

            $this->mssql->delete($TABLE);

            return true;
        } catch (Exception $e) {
            return false;
        }

    }





    public function QueryResources($data = array())
    {
        $ex = [
            "JOIN" => [
                "TABLE_NAME" => [
                    "ON" => "FORM_RUNNO",
                    "TYPE" => "INNER/LEFT/RIGHT/FULL",
                    "JOIN" => NULL,
                    "KEY_JOIN" => NULL,
                ]
            ],
            "GROUP_BY" => [
                "TABLE_NAME" => ["VALUE"]
            ],
            "SELECT" => [
                "TABLE_NAME" => ["VALUE"],
                "CUSTOMS" => ["VALUE"] || "VAL"
            ],
            "WHERE" => [
                "TABLE_NAME" => [
                    "COLUMN_NAME" => "VALUE",
                    "COLUMN_NAMES" => [
                        "DATA" => "VALUE",
                        "CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
                        "GROUP" => TRUE || FALSE,
                    ],

                    "GROUPS_1-10" => [
                        "GROUP_AND" => "OR || AND",
                        "GROUP_1-10" => [
                            "GROUP_AND" => "OR || AND",
                            "COLUMN_NAME" => [
                                "DATA" => "NULL" || NULL || "string" || "array",
                                "CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
                            ],
                        ],
                        "COLUMN_NAME" => [
                            "DATA" => "VALUE" || ["VALUE"],
                            "CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIK/OR_LIKE",
                            "GROUP" => TRUE || FALSE,
                        ],
                    ],

                ],
                "CUSTOMS" => "SQL TEXT" || ["SQL TEXT"],
            ],
            "ORDER_BY" => [
                "TABLE_NAME" => [
                    "KET" => "DESC||ASC"
                ]
            ],
            "TYPE_RESULT" => "object||array",
            "ONE_ROW" => false || TRUE,
            "TABLE_NAME" => self::TB_NAME()
        ];

        $temp_data = array();
        if (empty($data)) {
            $temp_data = $this->data;
        } else {
            $temp_data = $data;
        }


        // ค่าเริ่มต้น
        $temp = array();
        $JOIN = array();
        $GROUP_BY = array();
        $SELECT = array();
        $WHERE = array();
        $ORDER_BY = array();
        $TYPE_RESULT = 'object';
        $ONE_ROW = false;
        $TABLE_NAME = self::TB_NAME();


        if (empty($temp_data)) {
            $this->mssql->from(self::TB_NAME());
            $query = $this->mssql->get();
            $temp = $query->result_object();
            return $temp;
        } else {
            $temp_data = (object) $temp_data;
        }



        $JOIN = isset($temp_data->JOIN) ? $temp_data->JOIN : array();
        $GROUP_BY = isset($temp_data->GROUP_BY) ? $temp_data->GROUP_BY : array();
        $SELECT = isset($temp_data->SELECT) ? $temp_data->SELECT : array();
        $WHERE = isset($temp_data->WHERE) ? $temp_data->WHERE : array();
        $ORDER_BY = isset($temp_data->ORDER_BY) ? $temp_data->ORDER_BY : array();
        $TYPE_RESULT = isset($temp_data->TYPE_RESULT) ? $temp_data->TYPE_RESULT : 'object';
        $ONE_ROW = isset($temp_data->ONE_ROW) ? $temp_data->ONE_ROW : false;
        $TABLE_NAME = isset($temp_data->TABLE_NAME) ? $temp_data->TABLE_NAME : self::TB_NAME();

        $this->mssql->from($TABLE_NAME);

        if (!empty($WHERE)) {
            foreach ($WHERE as $key_WHERE => $item_WHERE):

                if ($key_WHERE == "CUSTOMS") {
                    if (gettype($item_WHERE) == "array") {
                        foreach ($item_WHERE as $item) {
                            $this->mssql->where($item);
                        }

                    }

                    if (gettype($item_WHERE) == "string") {
                        $this->mssql->where($item_WHERE);
                    }

                    continue;
                }

                if (gettype($item_WHERE) == 'array') {

                    foreach ($item_WHERE as $key_item_WHERE => $item_item_WHERE):
                        if ($key_item_WHERE !== 0) {

                            $TB_ = $key_WHERE;
                            $KE_ = $key_item_WHERE;

                            if ($key_item_WHERE == 'GROUPS_1' || $key_item_WHERE == 'GROUPS_2' || $key_item_WHERE == 'GROUPS_3' || $key_item_WHERE == 'GROUPS_4' || $key_item_WHERE == 'GROUPS_5' || $key_item_WHERE == 'GROUPS_6' || $key_item_WHERE == 'GROUPS_7' || $key_item_WHERE == 'GROUPS_8' || $key_item_WHERE == 'GROUPS_9' || $key_item_WHERE == 'GROUPS_10') {

                                if ($item_item_WHERE !== null) {

                                    if (isset($item_item_WHERE['GROUP_AND'])) {
                                        if ($item_item_WHERE['GROUP_AND'] == 'AND') {
                                            $this->mssql->group_start();
                                        } else {
                                            $this->mssql->or_group_start();
                                        }
                                    } else {
                                        $this->mssql->group_start();
                                    }



                                    foreach ($item_item_WHERE as $dki => $dii):


                                        if ($dki === 'GROUP_AND') {
                                            continue;
                                        }



                                        if ($dki === 'GROUP_1' || $dki === 'GROUP_2' || $dki === 'GROUP_3' || $dki === 'GROUP_4' || $dki === 'GROUP_5') {


                                            if (isset($dii['GROUP_AND'])) {
                                                if ($dii['GROUP_AND'] == 'AND') {
                                                    $this->mssql->group_start();
                                                } else if ($dii['GROUP_AND'] == 'OR') {
                                                    $this->mssql->or_group_start();
                                                }
                                            } else {
                                                $this->mssql->group_start();
                                            }

                                            $temp = array();

                                            foreach ($dii as $kgroupi => $kgroupii):

                                                $DGS_COL = $kgroupi;
                                                $DGS_DATA = isset($kgroupii['DATA']) ? $kgroupii['DATA'] : array();
                                                $DGS_CONDITION = strtoupper(isset($kgroupii['CONDITION']) ? $kgroupii['CONDITION'] : 'and');
                                                $DGSGROUP = isset($kgroupii['GROUP_AND']) ? $kgroupii['GROUP_AND'] : NULL;


                                                if ($kgroupi === 'GROUP_AND') {
                                                    continue;
                                                }


                                                if (empty($DGS_DATA)) {
                                                    continue;
                                                }

                                                // return  $kgroupii;
                                                $DGS_DATA = $DGS_DATA === 'NULL' ? NULL : $DGS_DATA;



                                                if ($DGSGROUP == 'AND') {
                                                    $this->mssql->group_start();
                                                } else if ($DGSGROUP == 'OR') {
                                                    $this->mssql->or_group_start();
                                                }


                                                switch ($DGS_CONDITION) {

                                                    case 'AND':
                                                        if (gettype($DGS_DATA) == "array") {

                                                            foreach ($DGS_DATA as $DGSKI => $DGSII):
                                                                $this->mssql->where(sprintf("%s.%s", $TB_, $DGS_COL), $DGSII, FALSE);
                                                            endforeach;

                                                        } else {

                                                            $this->mssql->where(sprintf("%s.%s", $TB_, $DGS_COL), $DGS_DATA);

                                                        }
                                                        break;
                                                }


                                                if (isset($DGSGROUP)) {
                                                    $this->mssql->group_end();
                                                }

                                            endforeach;


                                            $this->mssql->group_end();
                                            continue;
                                        }


                                        $D_COL = $dki;
                                        $D_DATA = isset($dii['DATA']) ? $dii['DATA'] : array();
                                        $D_CONDITION = strtoupper(isset($dii['CONDITION']) ? $dii['CONDITION'] : 'and');
                                        $GROUP = isset($dii['GROUP']) ? $dii['GROUP'] : false;


                                        if (empty($D_DATA)) {
                                            continue;
                                        }

                                        $D_DATA = $D_DATA === 'NULL' ? NULL : $D_DATA;

                                        // return $D_DATA;
                                        switch ($D_CONDITION) {
                                            case 'OR_LIKE':
                                                if (gettype($D_DATA) == "array") {
                                                    if ($GROUP == true) {
                                                        $this->mssql->group_start();
                                                    }


                                                    foreach ($D_DATA as $key_DK => $item_DK):
                                                        $this->mssql->or_like(sprintf("%s.%s", $TB_, $D_COL), $item_DK, 'both');
                                                    endforeach;

                                                    if ($GROUP == true) {
                                                        $this->mssql->group_end();
                                                    }

                                                } else {
                                                    $this->mssql->or_like(sprintf("%s.%s", $TB_, $D_COL), $D_DATA, 'both');
                                                }
                                                break;
                                            case 'AND':
                                                // $this->mssql->where(sprintf('%s.%s = %s', $TB_, $D_COL), $D_DATA, FALSE);
                                                if (gettype($D_DATA) == "array") {
                                                    if ($GROUP == true) {
                                                        $this->mssql->group_start();
                                                    }
                                                    foreach ($D_DATA as $key_DK => $item_DK):
                                                        $this->mssql->where(sprintf("%s.%s", $TB_, $D_COL), $item_DK, FALSE);
                                                    endforeach;
                                                    if ($GROUP == true) {
                                                        $this->mssql->group_end();
                                                    }
                                                } else {
                                                    // $this->mssql->where();
                                                    $this->mssql->where(sprintf("%s.%s", $TB_, $D_COL), $D_DATA);

                                                }
                                                break;
                                        }

                                    endforeach;

                                    $this->mssql->group_end();

                                }

                                continue;
                            }

                            if (gettype($item_item_WHERE) == "array") {

                                $item_item_WHERE = (object) $item_item_WHERE;
                                $item_item_WHERE_array = $item_item_WHERE;

                                $CONDITION = strtoupper(isset($item_item_WHERE->CONDITION) ? $item_item_WHERE->CONDITION : 'and');
                                $DATA_K = isset($item_item_WHERE->DATA) ? $item_item_WHERE->DATA : array();
                                $GROUP = isset($item_item_WHERE->GROUP) ? $item_item_WHERE->GROUP : false;

                                if (empty($DATA_K)) {
                                    continue;
                                }

                                switch ($CONDITION) {
                                    case 'OR':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->or_where(sprintf("%s.%s", $TB_, $KE_), $item_DK);
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->or_where(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }
                                        break;
                                    case 'IN':
                                        if (gettype($DATA_K) == "array") {

                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }

                                        } else {
                                            $this->mssql->where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                        }

                                        break;
                                    case 'OR_IN':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->or_where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->or_where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }
                                        break;
                                    case 'NOT_IN':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }

                                        break;
                                    case 'OR_NOT_IN':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            $this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }

                                        } else {
                                            $this->mssql->or_where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

                                        }
                                        break;
                                    case 'AND':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $item_DK);
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
                                        }
                                        break;
                                    case 'LIKE':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->like(sprintf("%s.%s", $TB_, $KE_), $item_DK, 'both');
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->like(sprintf("%s.%s", $TB_, $KE_), $DATA_K, 'both');
                                        }
                                        break;
                                    case 'OR_LIKE':
                                        if (gettype($DATA_K) == "array") {
                                            if ($GROUP == true) {
                                                $this->mssql->group_start();
                                            }
                                            foreach ($DATA_K as $key_DK => $item_DK):
                                                $this->mssql->or_like(sprintf("%s.%s", $TB_, $KE_), $item_DK, 'both');
                                            endforeach;
                                            if ($GROUP == true) {
                                                $this->mssql->group_end();
                                            }
                                        } else {
                                            $this->mssql->or_like(sprintf("%s.%s", $TB_, $KE_), $DATA_K, 'both');
                                        }
                                        break;
                                }
                            } else {
                                $this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $item_item_WHERE);
                            }
                        }
                    endforeach;
                }
            endforeach;
        }




        if (!empty($SELECT)) {
            $count_select = 0;
            $temp_SELECT = '';
            foreach ($SELECT as $key_seletct => $item_seletct):

                if ($key_seletct == "CUSTOMS") {
                    if (gettype($item_seletct) == "array") {
                        foreach ($item_seletct as $item) {
                            $this->mssql->select($item,FALSE );
                        }

                    }

                    if (gettype($item_seletct) == "string") {
                        $this->mssql->select($item_seletct,FALSE );
                    }

                    continue;
                }


                $temp_SELECT .= $count_select == 0 ? ' ' : ",";
                foreach ($item_seletct as $key_item_seletct => $item_item_seletct):
                    $temp_SELECT .= $key_item_seletct == 0 ? ' ' : ",";
                    $temp_SELECT .= " " . $key_seletct . '.' . $item_item_seletct . ' ';
                endforeach;
                $count_select++;
            endforeach;
            $this->mssql->select($temp_SELECT);
        }

        if (!empty($GROUP_BY)) {
            $temp_GROUP = '';
            $count_group = 0;
            foreach ($GROUP_BY as $key_group => $item_group):
                $temp_GROUP .= $count_group == 0 ? ' ' : ",";
                foreach ($item_group as $key_item_group => $item_item_group):
                    $temp_GROUP .= $key_item_group == 0 ? '' : ",";
                    $temp_GROUP .= "$key_group" . '.' . $item_item_group . ' ';
                endforeach;
                $count_group++;
            endforeach;
            if (empty($SELECT)) {
                $this->mssql->select($temp_GROUP);
            }
            $this->mssql->group_by($temp_GROUP);
        }


        if (empty($SELECT) && empty($GROUP_BY)) {
            $this->mssql->select("*");
        }


        if (!empty($JOIN)) {
            foreach ($JOIN as $key => $item):
                $TBL_JOIN = $key;
                $ON = isset($item['ON']) ? $item['ON'] : self::$sPRIMARY_KEY;
                $JOIN = isset($item['JOIN']) ? $item['JOIN'] : $TABLE_NAME;
                $KEY_JOIN = isset($item['KEY_JOIN']) ? $item['KEY_JOIN'] : $ON;
                $TYPE = isset($item['TYPE']) ? $item['TYPE'] : 'INNER';

                $this->mssql->join($TBL_JOIN, "{$JOIN}.{$KEY_JOIN} = {$TBL_JOIN}.{$ON}  ", "{$TYPE}");
            endforeach;
        }

        if (!empty($ORDER_BY)) {
            foreach ($ORDER_BY as $key_ORDER_BY => $item_ORDER_BY):
                $TBL_ = $key_ORDER_BY;
                foreach ($item_ORDER_BY as $key_item_ORDER_BY => $item_item_ORDER_BY):
                    $this->mssql->order_by("{$TBL_}.{$key_item_ORDER_BY}", $item_item_ORDER_BY);
                endforeach;
            endforeach;
        }


        // 
        // $sql = $this->mssql->get_compiled_select();


        try {
            $query = $this->mssql->get();

            if ($TYPE_RESULT == 'object' && $ONE_ROW != true) {
                $temp = $query->result_object();
            } elseif ($TYPE_RESULT == 'array' && $ONE_ROW != true) {
                $temp = $query->result_array();
            } elseif ($TYPE_RESULT == 'object' && $ONE_ROW == true) {
                $temp = $query->row_object();
            } elseif ($TYPE_RESULT == 'array' && $ONE_ROW == true) {
                $temp = $query->row_array();
            } else {
                $temp = $query->result_object();
            }

            return $temp;
        } catch (Exception $e) {
            return $temp;
            // return $temp;
        }


    }


    /**
     * Get the value of DB
     */
    public function getDB()
    {
        return $this->DB;
    }

    /**
     * Set the value of DB
     *
     * @return  self
     */
    public function setDB($DB)
    {
        $this->DB = $DB;

        return $this;
    }

    /**
     * Get the value of SCHEMA
     */
    public function getSCHEMA()
    {
        return $this->SCHEMA;
    }

    /**
     * Set the value of SCHEMA
     *
     * @return  self
     */
    public function setSCHEMA($SCHEMA)
    {
        $this->SCHEMA = $SCHEMA;

        return $this;
    }


    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of TABLE
     */
    public function getTABLE()
    {
        return $this->TABLE;
    }

    /**
     * Set the value of TABLE
     *
     * @return  self
     */
    public function setTABLE($TABLE)
    {
        $this->TABLE = $TABLE;

        return $this;
    }





    /**
     * Get the value of join
     */
    public function getJoin()
    {
        return $this->join;
    }

    /**
     * Set the value of join
     *
     * [
     *   "TABLE_NAME" => [
     *       "ON" => "FORM_RUNNO",
     *       "TYPE" => "INNER/LEFT/RIGHT/FULL",
     *       "JOIN" => NULL,
     *       "KEY_JOIN" => NULL,
     *   ]
     *   ],
     * @return  self
     */
    public function setJoin($join)
    {
        $this->join = $join;

        return $this;
    }

    /**
     * Get the value of where
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * Set the value of where
    [
        "TABLE_NAME" => [
            "COLUMN_NAME" => "VALUE",
            "COLUMN_NAMES" => [
                "DATA" => "VALUE",
                "CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
                "GROUP" => TRUE || FALSE,
            ],
            "GROUPS_1-10" => [
                "GROUP_AND" => "OR || AND",
                "GROUP_1-10" => [
                    "GROUP_AND" => "OR || AND",
                    "COLUMN_NAME" => [
                        "DATA" => "NULL" || NULL || "string" || "array",
                        "CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
                    ],
                ],
                "COLUMN_NAME" => [
                    "DATA" => "VALUE" || ["VALUE"],
                    "CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIK/OR_LIKE",
                    "GROUP" => TRUE || FALSE,
                ],
            ],
        ],
        "CUSTOMS" => "SQL TEXT" || ["SQL TEXT"],
    ]
     *
     * @return  self
     */
    public function setWhere($where)
    {

        $this->where = $where;

        return $this;
    }

    /**
     * Get the value of select
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Set the value of select
     *
     * [
     *    "TABLE_NAME" => ["VALUE"],
     *    "CUSTOMS" => ["VALUE"] || "VAL"
     *  ],
     * 
     * @return  self
     */

    public function setSelect($select)
    {
        $this->select = $select;

        return $this;
    }

    /**
     * Get the value of order_by
     */
    public function getOrder_by()
    {
        return $this->order_by;
    }

    /**
     * Set the value of order_by
     *
     * @return  self
     */
    public function setOrder_by($order_by)
    {
        $this->order_by = $order_by;

        return $this;
    }

    /**
     * Get the value of results
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set the value of results
     *
     * @return  self
     */
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * Get the value of rowOne
     */
    public function getRowOne()
    {
        return $this->rowOne;
    }

    /**
     * Set the value of rowOne
     *
     * @return  self
     */
    public function setRowOne($rowOne)
    {
        $this->rowOne = $rowOne;

        return $this;
    }

    /**
     * Get the value of group_by
     */
    public function getGroup_by()
    {
        return $this->group_by;
    }

    /**
     * Set the value of group_by
     *
     * @return  self
     */
    public function setGroup_by($group_by)
    {
        $this->group_by = $group_by;

        return $this;
    }

    /**
     * Get the value of KEYID
     */
    public function getKEYID()
    {
        return $this->KEYID;
    }

    /**
     * Set the value of KEYID
     *
     * @return  self
     */
    public function setKEYID($KEYID)
    {
        $this->KEYID = $KEYID;

        return $this;
    }

    /**
     * Get the value of SQL
     */
    public function getSQL()
    {
        return $this->SQL;
    }

    /**
     * Set the value of SQL
     *
     * @return  self
     */
    public function setSQL($SQL)
    {
        $this->SQL = $SQL;

        return $this;
    }


    /**
     * Get the value of last_id
     */
    public function getLast_id()
    {
        return $this->last_id;
    }

    /**
     * Set the value of last_id
     *
     * @return  self
     */
    public function setLast_id($last_id)
    {
        $this->last_id = $last_id;

        return $this;
    }

    /**
     * Get the value of query_results
     */
    public function getQuery_results()
    {
        return $this->query_results;
    }

    /**
     * Set the value of query_results
     *
     * @return  self
     */
    public function setQuery_results($query_results)
    {
        $this->query_results = $query_results;

        return $this;
    }
}
