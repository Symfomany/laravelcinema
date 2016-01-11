<?php

namespace spec\App\Http\Cart;

use App\Http\Cart\ItemInterface;
use App\Http\Cart\MoviesItem;
use App\Http\Models\Movies;
use Illuminate\Database\Eloquent\Collection;
use PhpSpec\ObjectBehavior;

/**
 * Spec for Cart.
 */
class CartSpec extends ObjectBehavior
{
    /**
     * @param \App\Http\Cart\MoviesItem $movieitem
     */
    public function let(MoviesItem $movieitem, MoviesItem $movieitem2)
    {
        $movie = new Movies();
        $movie->prix = 50;
        $movie2 = new Movies();
        $movie2->prix = 150;
        $movieitem->getMovie()->willReturn($movie);
        $movieitem2->getMovie()->willReturn($movie2);
        $this->beConstructedWith([$movieitem, $movieitem2]);
        $this->getTotal()->shouldReturn(0);
        $this->shouldReturnAnInstanceOf('App\Http\Cart\Cart');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Cart\Cart');
        $this->getProducts()->shouldHaveCount(2);
        $this->getProducts()->shouldBeArray();
    }

    /**
     * @param \App\Http\Cart\MoviesItem $movieitem
     */
    public function it_add_cart(MoviesItem $movieitem)
    {
        $this->add($movieitem)->shouldReturn($this);
    }

    /**
     * Add in cart.
     */
    public function it_remove_cart()
    {
        $item = new MoviesItem(3);
        $this->remove($item)->shouldReturn($this);
    }

    /**
     * @param \App\Http\Cart\MoviesItem $movieitem
     */
    public function it_all_cart(MoviesItem $movieitem, MoviesItem $movieitem2)
    {
        $item = new MoviesItem(3);
        $this->add($item)->add($item)->add($item);
        $this->all()->shouldReturn([$movieitem, $movieitem2, $item, $item, $item]);
    }

    /**
     * Clear in cart.
     */
    public function it_clear_cart()
    {
        $this->clear()->shouldReturn([]);
    }

    /**
     * Countable in cart.
     */
    public function it_countable_cart()
    {
        $item = new MoviesItem(3);

        $this->add($item);
        $this->count()->shouldReturn(3);
    }

    /**
     * Countable in cart.
     */
    public function it_total_cart()
    {
        $this->total()->shouldReturn(200);
    }

    /**
     * Countable in cart.
     */
    public function it_is_emptycart()
    {
        $this->emptycart()->shouldReturn(false);
        $this->clear();
        $this->emptycart()->shouldReturn(true);
    }

    /**
     * Countable in cart.
     */
    public function it_additems(ItemInterface $item, ItemInterface $item2)
    {
        $collection = new Collection();
        $collection->add($item);
        $collection->add($item2);
        $this->addItems($collection)->shouldHaveCount(4);
    }
}
