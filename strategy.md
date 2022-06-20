## 여행자들을 위한 네비게이션 앱  
### 기능 및 방향성
1. 처음에는 차로 다니는 도로를 위한 방향을 제시하는 기능
2. 다음 업데이트에는 걸어다니는 도로를 위한 방향을 제시하는 기능 추가
3. 또 다음에는 대중 교통을 위한 방향을 제시하는 기능 추가

이런식으로 자꾸 기능 추가
### 문제 발생
1. 새로운 기능(알고리즘)이 추가될 때마다 네비게이션의 main class 가 자꾸 비대해짐
2. 간단한 버그 수정같은 알고리즘을 변경할 때마다 전체 클래스에 영향을 끼치므로 이미 작동하는 코드에서 오류가 발생.

그니까 매우 큰 클래스 하나 때문에 팀들간 소스충돌도 발생하고 난리도 아님

### 해결방법
1. 추가된 기능(알고리즘)을 하는 클래스를 전략이라고 부르고 분리한다.
2. context라 불리는 original class는 빈드시 각 전략(알고리즘)을 참조하는 field를 저장해야 한다.
3. 이 context는 각 전략을 직접 하는 대신, 각 전략(field)이 참조하는 class에 그 일을 위임한다.
4. context는 작업에 적합한 알고리즘을 선택하는 책임이 없습니다. 대신 client가 context에 원하는 전략을 넘겨줍니다.
5. 실제로 context는 전략이 뭘 하는지 모릅니다.
6. It works with all strategies through the same generic interface, which only exposes a single method for triggering the algorithm encapsulated within the selected strategy.

* context는 전략 구현체와 독립적입니다. 그래서 새로운 알고리즘을 추가하거나, 기존 코드를 변경할 때, 다른 전략코드 수정이나, context변경 없이 가능하게 됩니다.

![img.png](images/strategy1.png)
1. 각 라우트 알고리즘은 단일 buildRoute메서드를 이용하여 단일 클래스로 추출할 수 있습니다.
2. The method accepts an origin and destination and returns a collection of the route’s checkpoints.
3. Even though given the same arguments, each routing class might build a different route, the main navigator class doesn’t really care which algorithm is selected since its primary job is to render a set of checkpoints on the map.
4. The class has a method for switching the active routing strategy, so its clients, such as the buttons in the user interface, can replace the currently selected routing behavior with another one.
---
## Real-World Analogy
공항에 가야하는 상황입니다.
1. 버스를 타거나
2. 택시를 타거나
3. 자전거를 탈 수 있습니다.

이것들은 이동수단 전략들 입니다. 당신은 1.예산, 2.시간 같은 요인에 의존해서 전략중 하나를 선택할 수 있습니다.

![img.png](images/strategy2.png)
1. Context는 전략구현체중 하나를 참조하는 필드를 유지하고, 오직 전략 interface와만 통신하여 이 객체와 통신할 수 있습니다.
2. 전략 interface는 모든 전략 구현체의 공통 인터페이스입니다. context가 전략 구현체를 사용하기 위한 메서드를 선언합니다.
3. 전략 구현체들은 각 전략에 대한 알고리즘을 구현합니다.
4. context는 알고리즘 실행이 필요할 때마다 전략 구현 객체에 연결된 실행 메서드를 호출합니다. 
여기서 context는 어떤타입의 전략이 실행되는지 모르고, 알고리즘이 어떻게 실행되는지 모릅니다.
5. Client는 구체적인 전략 객체를 만들고, context에 매개변수를 전달합니다. 
context는 setter메서드를 노출시키고, 이건 런타임에 client가 전략을 바꿀 수 있게 합니다.

### Applicability
1. 객체 내에서 다양한 알고리즘 변형을 사용하고, 런타임 중에 한 알고리즘에서 다른 알고리즘으로 전환할 수 있습니다.
2. The Strategy pattern lets you indirectly alter the object’s behavior at runtime by associating it with different sub-objects which can perform specific sub-tasks in different ways.
3. 일부 동작만 실행하는 방식만 다른 유사한 클래스가 있을 때 사용합니다.
4. 다양한 동작을 별도의 클래스 계층으로 추출하고 원래 클래스를 하나로 결합하여 중복 코드를 줄일 수 있습니다.
5. Use the pattern to isolate the business logic of a class from the implementation details of algorithms that may not be as important in the context of that logic.
6. The Strategy pattern lets you isolate the code, internal data, and dependencies of various algorithms from the rest of the code. Various clients get a simple interface to execute the algorithms and switch them at runtime.
7. 클래스에 동일한 알고리즘의 다른 변형 간에 전환하는 대규모 조건문이 있는 경우 패턴을 사용합니다.
8. 전략 패턴을 사용하면 모든 알고리즘을 동일한 인터페이스를 구현하는 별도의 클래스로 추출하여 이러한 조건을 제거할 수 있습니다. 원래 개체는 알고리즘의 모든 변형을 구현하는 대신 이러한 개체 중 하나에 실행을 위임합니다.

### How to Implement
1. 컨텍스트 클래스에서 자주 변경되기 쉬운 알고리즘을 식별합니다. 런타임에 동일한 알고리즘의 변형을 선택하고 실행하는 대규모 조건일 수도 있습니다.
2. 알고리즘의 모든 변형에 공통적인 전략 인터페이스를 선언합니다.
3. 하나씩 모든 알고리즘을 자체 클래스로 추출합니다. 그들은 모두 전략 인터페이스를 구현해야 합니다.
4. 컨텍스트 클래스에서 전략 개체에 대한 참조를 저장하기 위한 필드를 추가합니다. 해당 필드의 값을 대체하기 위한 setter를 제공하십시오. 컨텍스트는 전략 인터페이스를 통해서만 전략 개체와 함께 작동해야 합니다. 컨텍스트는 전략이 데이터에 액세스할 수 있도록 하는 인터페이스를 정의할 수 있습니다.
5. 컨텍스트의 클라이언트는 컨텍스트가 기본 작업을 수행할 것으로 기대하는 방식과 일치하는 적절한 전략과 컨텍스트를 연관시켜야 합니다.