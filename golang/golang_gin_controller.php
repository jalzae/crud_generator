<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$method = $_POST["method"];
$fungsi = $_POST["fungsi"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();

while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];


echo 'package controllers

import (
	"errors"
	"net/http"
	"rest/config"
	"rest/models"
	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
)';

echo '&#13;';

echo '
type ' . $dbnya . 'Repo struct {
	Db *gorm.DB
}';

echo '&#13;';

echo '
func ' . ucfirst($dbnya) . 'Controll() *' . $dbnya . 'Repo {
	db := config.InitDb()
	db.AutoMigrate(&models.' . ucfirst($dbnya) . '{})
	return &' . $dbnya . 'Repo{Db: db}
}';
echo '&#13;';
////fungsi create
echo 'func (repository *' . $dbnya . 'Repo) Create' . $dbnya . '(c *gin.Context) {
	var user models.' . ucfirst($dbnya) . '

	if err := c.ShouldBindJSON(&user); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	models.Create' . $dbnya . '(repository.Db, &user)
	c.JSON(http.StatusOK, gin.H{"data": user})

}';
echo '&#13;';
///fungsi getall
echo 'func (repository *' . $dbnya . 'Repo) Get' . $dbnya . 's(c *gin.Context) {
	var user []models.' . ucfirst($dbnya) . '
	err := models.Get' . $dbnya . 's(repository.Db, &user)
	if err != nil {
		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, user)
}';
echo '&#13;';

//get user by id
echo 'func (repository *' . $dbnya . 'Repo) Get' . $dbnya . '(c *gin.Context) {
	id, _ := c.Params.Get("id")
	var user models.' . ucfirst($dbnya) . '
	err := models. Get' . $dbnya . '(repository.Db, &user, id)
	if err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			c.AbortWithStatus(http.StatusNotFound)
			return
		}

		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, user)
}';

echo '&#13;';

// update user
echo '
func (repository *' . $dbnya . 'Repo) Update' . $dbnya . '(c *gin.Context) {
	var user models.' . ucfirst($dbnya) . '
	id, _ := c.Params.Get("id")
	err := models.Get' . $dbnya . '(repository.Db, &user, id)
	if err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			c.AbortWithStatus(http.StatusNotFound)
			return
		}

		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.BindJSON(&user)
	err = models.Update' . $dbnya. '(repository.Db, &user)
	if err != nil {
		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, user)
}';
echo '&#13;';

// delete user
echo '
func (repository *' . $dbnya . 'Repo) Delete' . $dbnya . '(c *gin.Context) {
	var user models.' . ucfirst($dbnya) . '
	id, _ := c.Params.Get("id")
	err := models.Delete' . $dbnya . '(repository.Db, &user, id)
	if err != nil {
		c.AbortWithStatusJSON(http.StatusInternalServerError, gin.H{"error": err})
		return
	}
	c.JSON(http.StatusOK, gin.H{"message": "' . $dbnya . ' deleted successfully"})
}';
// $hasil = count($dbs);
// for ($i = 1; $i < $hasil; $i++) {
// print_r('&#13;"' . $dbs[$i] . '"=>$' . $dbs[$i] . ',');
// }

mysqli_close($success);
