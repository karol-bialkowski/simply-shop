<?php

namespace App\Product\Domain;

use App\Product\Domain\ValueObject\ProductDescription;
use App\Product\Domain\ValueObject\ProductName;
use Doctrine\ORM\Mapping as ORM;

/**
 * TODO: Remove declaration Doctrine columns from this model.
 * TODO: The model should not know that later something creates a new database row of this object.
 */

/**
 * @ORM\Entity()
 * // * @ORM\Entity(repositoryClass="App\Product\Infrastructure\Doctrine\ORM\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name;
    public const NAME_MAX_LENGTH = 255; //TODO: refactor these options to one declaration
    public const NAME_MIN_LENGTH = 1;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $description;
    public const DESCRIPTION_MAX_LENGTH = 255;
    public const DESCRIPTION_MIN_LENGTH = 100;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned"=true})
     * //     * @ORM\Embedded(class="\Money\Money") TODO
     */
    private int $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    public function __construct(ProductName $name, ProductDescription $description, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created_at = new \DateTime('now');
        $this->updated_at = null;
    }
}