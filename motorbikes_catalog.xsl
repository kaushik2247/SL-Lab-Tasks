<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" indent="yes"/>
<xsl:template match="/">
<html>
<head>
<title>Motorbikes Catalog</title>
<style>
body {
font-family: Arial, sans-serif;
margin: 20px;
background-color: #f4f4f4;
}
h1 {
color: #333;
}
table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
background-color: #fff;
}
th, td {
border: 1px solid #ddd;
padding: 10px;
text-align: left;
}
th {
background-color: #007bff;
color: white;
}
tr:nth-child(even) {
background-color: #f9f9f9;
}
</style>
</head>
<body>
<h1>Motorbikes Catalog</h1>
<table>
<thead>
<tr>
<th>Make</th>
<th>Model</th>
<th>Year</th>
<th>Color</th>
<th>Engine Number</th>
<th>Fuel Type</th>
<th>Cylinders</th>
<th>Chassis Number</th>
<th>Accessories</th>
</tr>
</thead>
<tbody>
<xsl:for-each select="catalog/motorbike">
<tr>
<td><xsl:value-of select="make"/></td>
<td><xsl:value-of select="model"/></td>
<td><xsl:value-of select="year"/></td>
<td><xsl:value-of select="color"/></td>
<td><xsl:value-of select="engine/engine_number"/></td>
<td><xsl:value-of select="engine/type_of_fuel"/></td>
<td><xsl:value-of select="engine/number_of_cylinders"/></td>
<td><xsl:value-of select="chassis_number"/></td>
<td>
<xsl:value-of select="accessories/@disc_brake"/>, 
<xsl:value-of select="accessories/@auto_start"/>, 
<xsl:value-of select="accessories/@radio"/>
</td>
</tr>
</xsl:for-each>
</tbody>
</table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
