<?php
/**
 * Class Blocks
 *
 * @author   Facundo Capua <facundocapua@gmail.com>
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace MugAR\CmsGraphQl\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Blocks
    implements \Magento\Framework\GraphQl\Query\ResolverInterface
{
    /** @var \Magento\Cms\Api\BlockRepositoryInterface  */
    private $blockRepository;

    /** @var \Magento\Framework\GraphQl\Query\Resolver\ValueFactory  */
    private $valueFactory;

    public function __construct(
        \Magento\Cms\Api\BlockRepositoryInterface $blockRepository,
        \Magento\Framework\GraphQl\Query\Resolver\ValueFactory $valueFactory
    )
    {
        $this->blockRepository = $blockRepository;
        $this->valueFactory = $valueFactory;
    }


    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): Value {

        try {
            $data = $this->blockRepository->getById($args['block_id']);
            $return = function () use ($data) {
                return !empty($data) ? $data : [];
            };
            return $this->valueFactory->create($return);
        }catch (NoSuchEntityException $exception){
            throw new GraphQlNoSuchEntityException(__('There is no block with id %1', [$args['block_id']]));
        }
    }

}