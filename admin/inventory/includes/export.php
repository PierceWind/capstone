<?php  
//export.php  
session_start();
include ('../../server.php');

$output = "";

if(isset($_POST["export"])) {
    $query = "SELECT product.prodId, product.minReq, product.prodName, product.prodPrice,
    COALESCE(inventory.stock, 0) AS stock, COALESCE(SUM(sales.sales), 0) AS totalSales
    FROM product
    LEFT JOIN inventory ON product.prodId = inventory.prodCode
    LEFT JOIN sales ON product.prodId = sales.code
    GROUP BY product.prodId, product.minReq, product.prodName, product.prodPrice
    ORDER BY stock ASC;"; 
        
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th> Item Code </th>
                <th> Description </th>
                <th> Min Req </th>
                <th> Unit Price </th>
                <th> Available Stock  </th>
                <th> Sold Qty </th>
                <th> Status  </th>
            </tr>
        ';
        while($row = mysqli_fetch_array($result))
        {
            // Determine the status based on your conditions
            if ($row['stock'] <= $row['minReq']) {
                $status = 'Needs Attention';
            } elseif ($row['stock'] == 0) {
                $status = 'Out of Stock';
            } else {
                $status = 'Available';
            }
            $output .= '
            <tr>  
                <td>'.$row["prodId"].'</td>  
                <td>'.$row["prodName"].'</td>  
                <td>'.$row["minReq"].'</td>  
                <td>'.$row["prodPrice"].'</td>  
                <td>'.$row["stock"].'</td> 
                <td>'.$row["totalSales"].'</td>  
                <td>'.$status.'</td>
            </tr>
            ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=SalesAndInventoryReport.xls');
        echo $output;
    }
}
?>
