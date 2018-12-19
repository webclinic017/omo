<?php
App::uses('Component', 'Controller');
class DsbComponent extends Component
{

    /*
     *
     * */
    public function getLatestNews($limit=5)
    {
      //  Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'data_import' . DS . 'ez_sql_dsb.php');

        $sql="SELECT *
FROM  dsbp_posts
INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
WHERE  dsbp_posts.post_status LIKE  'publish'
AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
ORDER BY  dsbp_posts.post_date DESC
LIMIT 0 , $limit";



      //  $sql="SELECT *  FROM dsbp_posts WHERE post_status LIKE 'publish' ORDER BY dsbp_posts.post_date DESC LIMIT 0 , 5";
        $result = $db->get_results($sql);
//$db->debug();
       // exit;
        $allNews=array();
$liveNews=array();
        foreach($result as $row)
        {
            $post_id=$row->ID;
            $temp=array();
            $thumbnail_post_id=$row->meta_value;
            $tsql="SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr=$db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql="SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr=$db->get_results($taxsql);
       //     $db->debug();
            $tagArr=array();
            foreach($taxonomyArr as $tax)
            {
                $tagArr[]=$tax->name;
            }
          //  $db->debug();
            $temp['post_id']=$post_id;
            $temp['post_date']=$row->post_date;
            $temp['guid']=$row->guid;
            $temp['post_content']=$row->post_content;
            $temp['post_title']=$row->post_title;
            $temp['thmbnail']=$thumbArr[0]->guid;
            $temp['taxonomy']=$tagArr;
            $liveNews[]=$temp;

        }


        // Interview post fetching start

        $sql = "SELECT * FROM dsbp_posts
INNER JOIN dsbp_term_relationships
ON ( dsbp_posts.ID = dsbp_term_relationships.object_id )
INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
INNER JOIN dsbp_term_taxonomy
ON ( dsbp_term_relationships.term_taxonomy_id = dsbp_term_taxonomy.term_taxonomy_id )
WHERE dsbp_posts.post_status =  'publish'
AND dsbp_term_taxonomy.taxonomy =  'category'
AND dsbp_term_taxonomy.term_id =5
AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
ORDER BY dsbp_posts.post_date
DESC LIMIT 2";


        $result = $db->get_results($sql);
     //   $db->debug();

        $interviewNews=array();

        foreach($result as $row)
        {
            $post_id=$row->ID;
            $temp=array();
            $thumbnail_post_id=$row->meta_value;
            $tsql="SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr=$db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql="SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr=$db->get_results($taxsql);
            //     $db->debug();
            $tagArr=array();
            foreach($taxonomyArr as $tax)
            {
                $tagArr[]=$tax->name;
            }
            //  $db->debug();
            $temp['post_id']=$post_id;
            $temp['post_date']=$row->post_date;
            $temp['guid']=$row->guid;
            $temp['post_content']=$row->post_content;
            $temp['post_title']=$row->post_title;
            $temp['thmbnail']=$thumbArr[0]->guid;
            $temp['taxonomy']=$tagArr;
            $interviewNews[]=$temp;

        }
// Interview post fetching end



        // IPO post fetching start

        $sql = "SELECT * FROM dsbp_posts
INNER JOIN dsbp_term_relationships
ON ( dsbp_posts.ID = dsbp_term_relationships.object_id )
INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
INNER JOIN dsbp_term_taxonomy
ON ( dsbp_term_relationships.term_taxonomy_id = dsbp_term_taxonomy.term_taxonomy_id )
WHERE dsbp_posts.post_status =  'publish'
AND dsbp_term_taxonomy.taxonomy =  'category'
AND dsbp_term_taxonomy.term_id =8
AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
ORDER BY dsbp_posts.post_date
DESC LIMIT 3";


        $result = $db->get_results($sql);
        //   $db->debug();

        $ipoNews=array();

        foreach($result as $row)
        {
            $post_id=$row->ID;
            $temp=array();
            $thumbnail_post_id=$row->meta_value;
            $tsql="SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr=$db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql="SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr=$db->get_results($taxsql);
            //     $db->debug();
            $tagArr=array();
            foreach($taxonomyArr as $tax)
            {
                $tagArr[]=$tax->name;
            }
            //  $db->debug();
            $temp['post_id']=$post_id;
            $temp['post_date']=$row->post_date;
            $temp['guid']=$row->guid;
            $temp['post_content']=$row->post_content;
            $temp['post_title']=$row->post_title;
            $temp['thmbnail']=$thumbArr[0]->guid;
            $temp['taxonomy']=$tagArr;
            $ipoNews[]=$temp;

        }
// IPO  post fetching end


        // AGM post fetching start

        $sql = "SELECT * FROM dsbp_posts
INNER JOIN dsbp_term_relationships
ON ( dsbp_posts.ID = dsbp_term_relationships.object_id )
INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
INNER JOIN dsbp_term_taxonomy
ON ( dsbp_term_relationships.term_taxonomy_id = dsbp_term_taxonomy.term_taxonomy_id )
WHERE dsbp_posts.post_status =  'publish'
AND dsbp_term_taxonomy.taxonomy =  'category'
AND dsbp_term_taxonomy.term_id =7
AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
ORDER BY dsbp_posts.post_date
DESC LIMIT 2";


        $result = $db->get_results($sql);
        //   $db->debug();

        $agmNews=array();

        foreach($result as $row)
        {
            $post_id=$row->ID;
            $temp=array();
            $thumbnail_post_id=$row->meta_value;
            $tsql="SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr=$db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql="SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr=$db->get_results($taxsql);
            //     $db->debug();
            $tagArr=array();
            foreach($taxonomyArr as $tax)
            {
                $tagArr[]=$tax->name;
            }
            //  $db->debug();
            $temp['post_id']=$post_id;
            $temp['post_date']=$row->post_date;
            $temp['guid']=$row->guid;
            $temp['post_content']=$row->post_content;
            $temp['post_title']=$row->post_title;
            $temp['thmbnail']=$thumbArr[0]->guid;
            $temp['taxonomy']=$tagArr;
            $agmNews[]=$temp;

        }
// AGM post fetching end

        // bazar protidin post fetching start

        $sql = "SELECT * FROM dsbp_posts
INNER JOIN dsbp_term_relationships
ON ( dsbp_posts.ID = dsbp_term_relationships.object_id )
INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
INNER JOIN dsbp_term_taxonomy
ON ( dsbp_term_relationships.term_taxonomy_id = dsbp_term_taxonomy.term_taxonomy_id )
WHERE dsbp_posts.post_status =  'publish'
AND dsbp_term_taxonomy.taxonomy =  'category'
AND dsbp_term_taxonomy.term_id =2
AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
ORDER BY dsbp_posts.post_date
DESC LIMIT 2";


        $result = $db->get_results($sql);
        //   $db->debug();

        $marketAnalysisNews=array();

        foreach($result as $row)
        {
            $post_id=$row->ID;
            $temp=array();
            $thumbnail_post_id=$row->meta_value;
            $tsql="SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr=$db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql="SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr=$db->get_results($taxsql);
            //     $db->debug();
            $tagArr=array();
            foreach($taxonomyArr as $tax)
            {
                $tagArr[]=$tax->name;
            }
            //  $db->debug();
            $temp['post_id']=$post_id;
            $temp['post_date']=$row->post_date;
            $temp['guid']=$row->guid;
            $temp['post_content']=$row->post_content;
            $temp['post_title']=$row->post_title;
            $temp['thmbnail']=$thumbArr[0]->guid;
            $temp['taxonomy']=$tagArr;
            $marketAnalysisNews[]=$temp;

        }
// bazar protidin post fetching end




        $allNews['live']=$liveNews;
        $allNews['interview']=$interviewNews;
        $allNews['ipo']=$ipoNews;
        $allNews['agm']=$agmNews;
        $allNews['marketAnalysis']=$marketAnalysisNews;

       // pr($interviewNews);
     //   exit;


       // exit;
        return $allNews;
    }
    public function getPostByCategory($limit=5)
    {
        require_once(APP . 'Vendor' . DS . 'data_import' . DS . 'ez_sql_dsb.php');


        $sql = "SELECT * FROM dsbp_posts INNER JOIN dsbp_term_relationships ON ( dsbp_posts.ID = dsbp_term_relationships.object_id ) INNER JOIN dsbp_term_taxonomy ON ( dsbp_term_relationships.term_taxonomy_id = dsbp_term_taxonomy.term_taxonomy_id ) WHERE dsbp_posts.post_status =  'publish' AND dsbp_term_taxonomy.taxonomy =  'category' AND dsbp_term_taxonomy.term_id =6 ORDER BY dsbp_posts.post_date DESC LIMIT 2";


        $result = $db->get_results($sql);
        $db->debug();
        exit;

$allNews=array();
        foreach($result as $row)
        {
            $post_id=$row->ID;
            $temp=array();
            $thumbnail_post_id=$row->meta_value;
            $tsql="SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr=$db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql="SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr=$db->get_results($taxsql);
       //     $db->debug();
            $tagArr=array();
            foreach($taxonomyArr as $tax)
            {
                $tagArr[]=$tax->name;
            }
          //  $db->debug();
            $temp['post_id']=$post_id;
            $temp['post_date']=$row->post_date;
            $temp['guid']=$row->guid;
            $temp['post_content']=$row->post_content;
            $temp['post_title']=$row->post_title;
            $temp['thmbnail']=$thumbArr[0]->guid;
            $temp['taxonomy']=$tagArr;
            $allNews[]=$temp;

        }
       // exit;
        return $allNews;
    }





}
