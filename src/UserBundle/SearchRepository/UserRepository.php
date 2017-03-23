<?php

namespace UserBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;
use UserBundle\Model\UserSearch;

/**
 * Description of UserRepository
 *
 * @author omar
 */
class UserRepository extends Repository {

    public function search(UserSearch $userSearch) {
        // we create a query to return all the users
        // but if the criteria username is specified, we use it
        if ($userSearch->getUsername() != null && $userSearch != '') {
            $query = new \Elastica\Query\Match();
            $query->setFieldQuery('user.username', $userSearch->getUsername());
            $query->setFieldFuzziness('user.username', 0.7);
            $query->setFieldMinimumShouldMatch('user.username', '80%');
            //
        } else {
            $query = new \Elastica\Query\MatchAll();
        }
        $baseQuery = $query;

        // then we create filters depending on the chosen criterias
        $boolFilter = new \Elastica\Filter\BoolFilter();

        // Dates filter
        if (null !== $userSearch->getCreatedFrom() && null !== $userSearch->getCreatedTo()) {
            $boolFilter->addMust(new \Elastica\Filter\Range('createdAt', array(
                'gte' => \Elastica\Util::convertDate($userSearch->getCreatedFrom()->getTimestamp()),
                'lte' => \Elastica\Util::convertDate($userSearch->getCreatedTo()->getTimestamp())
                    )
            ));
        }

        // Enabled or not filter
        if ($userSearch->getIsEnabled() !== null) {
            $boolFilter->addMust(
                    new \Elastica\Filter\Terms('enabled', array($userSearch->getIsEnabled()))
            );
        }

        $filtered = new \Elastica\Query\Filtered($baseQuery, $boolFilter);

        $query = \Elastica\Query::create($filtered);

        return $this->find($query);
    }

}
